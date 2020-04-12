<?php

namespace English\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Cuongpm\Modularization\Facades\InputFa;
use English\Models\CrazyReadHistory;
use English\Http\Requests\CrazyHistoryCreateRequest;
use English\Http\Requests\CrazyHistoryUpdateRequest;
use English\Http\Repositories\CrazyHistoryRepository;
use Illuminate\Http\Request;
use Cuongpm\Modularization\MultiInheritance\ControllersTrait;

class CrazyHistoryController extends Controller
{
    use ControllersTrait;
    private $repository;

    public function __construct(CrazyHistoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['crazies.istories'] = $this->repository->myPaginate($input);
        if ($request->ajax()) {
            return view('en::admin.crazy-history.table', $data)->render();
        }
        return view('en::admin.crazy-history.index', $data);
    }

    public function create()
    {
        return view('en::admin.crazy-history.create');
    }

    public function store(CrazyHistoryCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        session()->flash('success', 'create success');
        return redirect()->route('admin.crazies.history.index');
    }

    public function show($id)
    {
        $crazyHistory = $this->repository->find($id);
        if (empty($crazyHistory)) {
            session()->flash('error', 'not found');
            return back();
        }
        return view('en::admin.crazy-history.show', compact('crazies.istory'));
    }

    public function edit($id)
    {
        $crazyHistory = $this->repository->find($id);
        if (empty($crazyHistory)) {
            session()->flash('error', 'not found');
            return back();
        }
        return view('en::admin.crazy-history.update', compact('crazies.istory'));
    }

    public function update(CrazyHistoryUpdateRequest $request, $id)
    {
        $input = $request->all();
        $crazyHistory = $this->repository->find($id);
        if (empty($crazyHistory)) {
            session()->flash('error', 'not found');
            return back();
        }
        $this->repository->change($input, $crazyHistory);
        session()->flash('success', 'update success');
        return redirect()->route('admin.crazies.history.index');
    }

    public function destroy($id)
    {
        $crazyHistory = $this->repository->find($id);
        if (empty($crazyHistory)) {
            session()->flash('error', 'not found');
        }
        $this->repository->delete($id);
        session()->flash('success', 'delete success');
        return back();
    }
}
