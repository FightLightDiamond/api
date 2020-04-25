<?php

namespace ACL\Http\Controllers\Admin;

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
use Illuminate\Support\Facades\Log;

class UserAdminController extends Controller
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try {
            $input = $request->all();
            $user = $this->repository->myPaginate($input);

            return response()->json($user);
        } catch (\Exception $exception) {
            Log::debug($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
    }

    public function show($id)
    {
        $this->repository->find($id);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $input = $request->all();
        $user = $this->repository->find($id);

        $this->repository->change($input, $user);
    }

    public function destroy($id)
    {
        $user = $this->repository->find($id);
        $this->repository->destroy($user);
    }

    public function profile()
    {
        $user = auth()->user();
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
    }

    public function renewPassword($id)
    {
        $user = $this->repository->find($id);
        $password = str_random(6);
        $this->repository->update(['password' => bcrypt($password)], $id);
        $user->notify(new RenewPassword($password));
        session()->flash('success', 'Change password success');
        return back();
    }

    public function ban($id)
    {
        $user = $this->repository->find($id);

        if ($user->active == 1) {
            $active = 0;
            $activeName = 'Inactive';
        } else {
            $active = 1;
            $activeName = 'Active';
        }

        $this->repository->update(['active' => $active], $id);
        $user->notify(new BanAccount($activeName));
    }
}
