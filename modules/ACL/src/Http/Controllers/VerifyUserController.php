<?php

namespace ACL\Http\Controllers;

use ACL\Models\VerifyUser;
use App\Http\Controllers\Controller;
use ACL\Http\Requests\VerifyUserCreateRequest;
use ACL\Http\Requests\VerifyUserUpdateRequest;
use ACL\Http\Repositories\VerifyUserRepository;
use Illuminate\Http\Request;
use Cuongpm\Modularization\MultiInheritance\ControllersTrait;

class VerifyUserController extends Controller
{
    use ControllersTrait;
    private $repository;

    public function __construct(VerifyUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['verifyUsers'] = $this->repository->myPaginate($input);
        if ($request->ajax()) {
            return view('acl::verify-user.table', $data)->render();
        }
        return view('acl::verify-user.index', $data);
    }

    public function create()
    {
        return view('acl::verify-user.create');
    }

    public function store(VerifyUserCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        session()->flash('success', 'create success');
        return redirect()->route('verify-users.index');
    }

    public function show($id)
    {
        $verifyUser = $this->repository->find($id);
        if (empty($verifyUser)) {
            session()->flash('error', 'not found');
            return back();
        }
        return view('acl::verify-user.show', compact('verifyUser'));
    }

    public function edit($id)
    {
        $verifyUser = $this->repository->find($id);
        if (empty($verifyUser)) {
            session()->flash('error', 'not found');
            return back();
        }
        return view('acl::verify-user.update', compact('verifyUser'));
    }

    public function update(VerifyUserUpdateRequest $request, $id)
    {
        $input = $request->all();
        $verifyUser = $this->repository->find($id);
        if (empty($verifyUser)) {
            session()->flash('error', 'not found');
            return back();
        }
        $this->repository->change($input, $verifyUser);
        session()->flash('success', 'update success');
        return redirect()->route('verify-users.index');
    }

    public function destroy($id)
    {
        $verifyUser = $this->repository->find($id);
        if (empty($verifyUser)) {
            session()->flash('error', 'not found');
        }
        $this->repository->delete($id);
        session()->flash('success', 'delete success');
        return back();
    }

    public function email($token)
    {
        $verify = $this->repository->filterFirst([TOKEN_COL => $token]);
        if ($verify) {

            $verify->email = 1;
            $verify->save();

            $user = $verify->user;
            if ($user && !$user->status) {
                $user->is_active = 1;
                $user->save();
            }
            session()->flash('success', 'Verify successfully');
        } else {
            session()->flash('error', 'Verify fail');
        }

        return back();
    }

}
