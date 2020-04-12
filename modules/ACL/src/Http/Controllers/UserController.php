<?php

namespace ACL\Http\Controllers;

use ACL\Http\Requests\CreateUserRequest;
use ACL\Http\Requests\PasswordUpdateRequest;
use ACL\Http\Requests\ProfileRequest;
use ACL\Http\Requests\UpdateUserRequest;
use ACL\Notifications\BanAccount;
use ACL\Notifications\RenewPassword;
use ACL\Http\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['users'] = $this->repository->myPaginate($input);
        if ($request->ajax()) {
            return view('acl::users.table', $data)->render();
        }
        return view('acl::users.index', $data);
    }

    public function create()
    {
        return view('acl::users.create');
    }

    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $this->repository->find($id);
    }

    public function edit($id)
    {
        $user = $this->repository->find($id);

        if (empty($user)) {
            session()->flash('error', 'Not found');
            return redirect(route('users.index'));
        }
//        $roleIds = $user->roles()
//            ->pluck('id')
//            ->toArray();
        return view('acl::users.update', compact('user', 'roleIds'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $input = $request->all();
        $user = $this->repository->find($id);
        if (empty($user)) {
            session()->flash('error', 'Not found');
        } else {
            $this->repository->change($input, $user);
            session()->flash('success', 'Update Success');
        }
        return redirect(route('users.index'));
    }

    public function destroy($id)
    {
        if (request()->ajax()) {
            $data = $this->repository->destroys(request()->get('id'));
            return response()->json($data);
        }
        $user = $this->repository->find($id);
        if (empty($user)) {
            session()->flash('error', 'Not found');
        }
        $this->repository->destroy($user);
        session()->flash('success', 'Delete Success');
        return redirect(route('users.index'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('acl::users.profile', compact('user'));
    }

    public function updateProfile($id, ProfileRequest $request)
    {
        $input = $request->all();
        $user = $this->repository->find($id);
        if (empty($user)) {
            session()->flash('error', 'Not found');
        } else {
            $this->repository->change($input, $user);
            session()->flash('success', 'Update Success');
        }
        return back();
    }

    public function changePassword(PasswordUpdateRequest $request)
    {
        $input = $request->all();
        if (!Auth::attempt(['email' => auth()->user()->email, 'password' => $input['old_password']])) {
            session()->flash('error', 'Password incorrect');
            return back();
        }
        $id = auth()->id();
        $password = Hash::make($input['new_password']);
        $this->repository->update(['password' => $password], $id);
        session()->flash('success', 'Change password success');
        return back();
    }

    public function renewPassword($id)
    {
        $user = $this->repository->find($id);
        if (empty($user)) {
            session()->flash('error', 'Not found');
        }
        $password = str_random(6);
        $this->repository->update(['password' => bcrypt($password)], $id);
        $user->notify(new RenewPassword($password));
        session()->flash('success', 'Change password success');
        return back();
    }

    public function ban($id)
    {
        $user = $this->repository->find($id);
        if (empty($user)) {
            session()->flash('error', 'Not found');
        }
        if($user->active == 1 ) {
            $active = 0;
            $activeName = 'Inactive';
        } else {
            $active = 1;
            $activeName = 'Active';
        }
        $this->repository->update(['active' => $active], $id);
        $user->notify(new BanAccount($activeName));
        session()->flash('success', $activeName . ' user success');
        return back();
    }

    public function transaction(Request $request)
    {
        $user = auth()->user();
        $password = $request->get('password');
        if (!Auth::attempt(['email' => $user->email, 'password' => $password])) {
            session()->flash('error', 'Password incorrect');
        } else {
            $coin = $user->coin;
            $coinTransaction = $request->get('coin');
            if($coin < $coinTransaction) {
                session()->flash('error', 'Số coin giao dịch lớn hơn số coin hiện tại');
            } else {
                $email = $request->get('email');
                if($email === $user->email) {
                    session()->flash('error', 'Bạn không thể giao dịch với chính mình');
                } else {
                    $receiver = $this->repository->filterFirst(['email' => $email]);
                    if($receiver)
                    {
                        $receiver->coin += $coinTransaction;
                        $receiver->save();
                        $user->coin -= $coinTransaction;
                        $user->save();
                        session()->flash('success', 'Giao dịch thành công');
                    } else {
                        session()->flash('error', 'Tài khoản không tồn tại');
                    }
                }
            }
        }
        return back();
    }
}
