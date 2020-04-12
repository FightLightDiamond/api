<?php

namespace ACL\Http\Controllers;

use App\Http\Controllers\Controller;
use Cuongpm\Modularization\Facades\InputFa;
use ACL\Http\Requests\RoleCreateRequest;
use ACL\Http\Requests\RoleUpdateRequest;
use ACL\Http\Repositories\RoleRepository;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $repository;
    const TABLE = ROLES_TB;
    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['roles'] = $this->repository->myPaginate($input);
        if ($request->ajax()) {
            return view('acl::roles.table', $data)->render();
        }
        return view('acl::roles.index', $data);
    }

    public function create()
    {
        return view('acl::roles.create');
    }

    public function store(RoleCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        return redirect()->route('roles.index');
    }

    public function show($id)
    {
        $role = $this->repository->find($id);
        if (empty($role)) {
            session()->flash(ERROR, 'Not found');
            return redirect(route('roles.index'));
        }
        return view( 'acl::roles.show', compact('role'));
    }

    public function edit($id)
    {
        $role = $this->repository->find($id);
        if (empty($role)) {
            session()->flash(ERROR, 'Not found');
            return redirect(route('roles.index'));
        }
        return view( 'acl::roles.update', compact('role'));
    }

    public function update(RoleUpdateRequest $request, $id)
    {
        $input = $request->all();
        $user = $this->repository->find($id);
        if (empty($user)) {
            session()->flash(ERROR, 'Not found');
        } else {
            $this->repository->change($input, $id);
            session()->flash(SUCCESS, 'Update Success');
        }
        return redirect(route('roles.index'));
    }

    public function destroy($id)
    {
        if (request()->ajax()) {
            $data = $this->repository->destroys(request()->get('id'));
            return response()->json($data);
        }

        $user = $this->repository->destroy($id);

        if (empty($user)) {
            session()->flash(ERROR, 'Not found');
        }
        session()->flash(SUCCESS, 'Update Success');
        return redirect(route('roles.index'));
    }

}
