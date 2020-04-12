<?php

namespace English\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Cuongpm\Modularization\Facades\InputFa;
use English\Models\CrazyDetail;
use English\Http\Requests\CrazyDetailCreateRequest;
use English\Http\Requests\CrazyDetailUpdateRequest;
use English\Http\Repositories\CrazyDetailRepository;
use Illuminate\Http\Request;
use Cuongpm\Modularization\MultiInheritance\ControllersTrait;

class CrazyDetailController extends Controller
{
    use ControllersTrait;
    private $repository;

    public function __construct(CrazyDetailRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['crazies.etails'] = $this->repository->myPaginate($input);
        if ($request->ajax()) {
            return view('en::admin.crazy-detail.table', $data)->render();
        }
        return view('en::admin.crazy-detail.index', $data);
    }

    public function create()
    {
        return view('en::admin.crazy-detail.create');
    }

    public function store(CrazyDetailCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        session()->flash('success', 'create success');
        return redirect()->route('admin.crazies.detail.index');
    }

    public function show($id)
    {
        $crazyDetail = $this->repository->find($id);
        if (empty($crazyDetail)) {
            session()->flash('error', 'not found');
            return back();
        }
        return view('en::admin.crazy-detail.show', compact('crazies.etail'));
    }

    public function edit($id)
    {
        $crazyDetail = $this->repository->find($id);
        if (empty($crazyDetail)) {
            session()->flash('error', 'not found');
            return back();
        }
        return view('en::admin.crazy-detail.update', compact('crazies.etail'));
    }

    public function update(CrazyDetailUpdateRequest $request, $id)
    {
        $input = $request->all();
        $crazyDetail = $this->repository->find($id);
        if (empty($crazyDetail)) {
            session()->flash('error', 'not found');
            return back();
        }
        $this->repository->change($input, $crazyDetail);
        session()->flash('success', 'update success');
        return redirect()->route('admin.crazies.detail.index');
    }

    public function destroy($id)
    {
        $crazyDetail = $this->repository->find($id);
        if (empty($crazyDetail)) {
            session()->flash('error', 'not found');
        }
        $this->repository->delete($id);
        session()->flash('success', 'delete success');
        return back();
    }
}
