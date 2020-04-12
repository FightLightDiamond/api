<?php

namespace English\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use English\Http\Requests\CrazyCreateRequest;
use English\Http\Requests\CrazyUpdateRequest;
use English\Http\Repositories\CrazyRepository;
use Illuminate\Http\Request;
use Cuongpm\Modularization\MultiInheritance\ControllersTrait;

class CrazyController extends Controller
{
    use ControllersTrait;
    private $repository;

    public function __construct(CrazyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['crazies'] = $this->repository->myPaginate($input);
        if ($request->ajax()) {
            return view('en::admin.crazy.table', $data)->render();
        }
        return view('en::admin.crazy.index', $data);
    }

    public function create()
    {
        return view('en::admin.crazy.create');
    }

    public function store(CrazyCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        session()->flash('success', 'create success');
        if(isset($input['is_back']))
        {
            return back();
        }
        return redirect()->route('admin.crazies.index');
    }

    public function show($id)
    {
        $crazy = $this->repository->find($id);
        if (empty($crazy)) {
            session()->flash('error', 'not found');
            return back();
        }
        return view('en::admin.crazy.show', compact('crazy'));
    }

    public function edit($id)
    {
        $data = $this->repository->edit($id);
        if (empty($data)) {
            session()->flash('error', 'not found');
            return back();
        }
        return view('en::admin.crazy.update', $data);
    }

    public function update(CrazyUpdateRequest $request, $id)
    {
        $input = $request->all();
        $crazy = $this->repository->find($id);
        if (empty($crazy)) {
            session()->flash('error', 'not found');
            return back();
        }
        $this->repository->change($input, $crazy);
        session()->flash('success', 'update success');
        if(isset($input['is_back']))
        {
            return back();
        }
        return redirect()->route('admin.crazies.index');
    }

    public function destroy($id)
    {
        $crazy = $this->repository->find($id);
        if (empty($crazy)) {
            session()->flash('error', 'not found');
        }
        $this->repository->delete($id);
        session()->flash('success', 'delete success');
        return back();
    }
}
