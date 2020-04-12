<?php

namespace ACL\Http\Controllers;

use App\Http\Controllers\Controller;
use ACL\Http\Requests\AdminCreateRequest;
use ACL\Http\Requests\AdminUpdateRequest;
use ACL\Http\Repositories\AdminRepository;
use Illuminate\Http\Request;
use Cuongpm\Modularization\MultiInheritance\ControllersTrait;


class AdminController extends Controller
{
    use ControllersTrait;
    private $repository;

    public function __construct(AdminRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['admins'] = $this->repository->myPaginate($input);
        if ($request->ajax()) {
            return view('acl::admin.table', $data)->render();
        }
        return view('acl::admin.index', $data);
    }

    public function create()
    {
        return view('acl::admin.create');
    }

    public function store(AdminCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        session()->flash('success', 'create success');
        return redirect()->route('admins.index');
    }

    public function show($id)
    {
        $admin = $this->repository->find($id);

        if (empty($admin)) {
            session()->flash('error', 'not found');
            return back();
        }

        return view('acl::admin.show', compact('admin'));
    }

    public function edit($id)
    {
        $admin = $this->repository->find($id);
        if (empty($admin)) {
            session()->flash('error', 'not found');
            return back();
        }
        return view('acl::admin.update', compact('admin'));
    }

    public function update(AdminUpdateRequest $request, $id)
    {
        $input = $request->all();
        $admin = $this->repository->find($id);
        if (empty($admin)) {
            session()->flash('error', 'not found');
            return back();
        }
        $this->repository->change($input, $admin);
        session()->flash('success', 'update success');
        return redirect()->route('admins.index');
    }

    public function destroy($id)
    {
        $admin = $this->repository->find($id);
        if (empty($admin)) {
            session()->flash('error', 'not found');
        }
        $this->repository->delete($id);
        session()->flash('success', 'delete success');
        return back();
    }
}
