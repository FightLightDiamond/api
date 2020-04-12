<?php

namespace ACL\Http\Controllers;

use ACL\Http\Facades\FoInput;
use ACL\Http\Requests\PermissionCreateRequest;
use ACL\Http\Requests\PermissionUpdateRequest;
use ACL\Http\Repositories\PermissionRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $repository;
    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $role_id = $request->get('role_id');
        $permission_id = DB::table('role_permission')->where('role_id', $role_id)->pluck('permission_id');
        $permissions = DB::table('permissions')->whereIn('id', $permission_id)->get();
        $data = [];
        foreach ($permissions as $row)
        {
            $data[$row->module_id] = [];
        }
        foreach ($permissions as $row)
        {
            array_push($data[$row->module_id], $row->access_id);
        }
        $levelList = [];
        $accessList = [];
        foreach ($data as $module_id => $access_ids)
        {
            $accessList[$module_id] = [];
            foreach ($access_ids as $access_id)
            {
                $accessList[$module_id][] = ACCESSES[$access_id];
            }
            $accessList[$module_id] = implode('|',  $accessList[$module_id]);
            sort($access_ids);
            foreach (ACCESS_LEVEL as $key => $accesses)
            {
                sort($accesses);
                if($access_ids == $accesses)
                {
                    $levelList[$module_id] = $key;
                }
            }
        }
        if($request->ajax())
        {
            return view('acl::permissions.table', compact('accessList', 'levelList', 'permissions'))->render();
        }
        return view('acl::permissions.index', compact('levelList', 'accessList', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('acl::permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionCreateRequest $request)
    {
        $input = $request->all();
        $data = $this->repository->create($input);
        if($data) {
            session()->flash('success', 'SUCCESS');
        } else {
            session()->flash('error', 'ERROR');
        }
        return redirect(route('permissions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = $this->repository->find($id);
        if(empty($permission))
        {
            session()->flash('error', 'NOT FOUND');
            return back();
        }
        return view('acl::permissions.update', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionUpdateRequest $request, $id)
    {
        $input = $request->all();
        $permission = $this->repository->find($id);
        if(empty($permission))
        {
            session()->flash('error', 'NOT FOUND');
            return back();
        }
        $data = $this->repository->change($input, $permission);
        if($data) {
            session()->flash('success', 'Update success');
            return back();
        } else {
            session()->flash('error', 'Update fail');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = $this->repository->find($id);
        if(empty($permission))
        {
            session()->flash('error', 'NOT FOUND');
            return back();
        }
        $this->repository->delete($id);
        session()->flash('success', 'Delete success');
        return back();
    }
}
