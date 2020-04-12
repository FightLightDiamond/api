<?php

namespace English\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use English\Http\Requests\CrazyWriteHistoryCreateRequest;
use English\Http\Requests\CrazyWriteHistoryUpdateRequest;
use English\Http\Repositories\CrazyWriteHistoryRepository;
use Illuminate\Http\Request;
use Cuongpm\Modularization\MultiInheritance\ControllersTrait;

class CrazyWriteHistoryController extends Controller
{
    use ControllersTrait;
    private $repository;

    public function __construct(CrazyWriteHistoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['crazyWriteHistories'] = $this->repository->myPaginate($input);
        if ($request->ajax()) {
            return view('en::admin.crazy-write-history.table', $data)->render();
        }
        return view('en::admin.crazy-write-history.index', $data);
    }

    public function create()
    {
        return view('en::admin.crazy-write-history.create');
    }

    public function store(CrazyWriteHistoryCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        session()->flash('success', 'create success');
        return redirect()->route('crazy-write-histories.index');
    }

    public function show($id)
    {
        $crazyWriteHistory = $this->repository->find($id);
        if (empty($crazyWriteHistory)) {
            session()->flash('error', 'not found');
            return back();
        }
        return view('en::admin.crazy-write-history.show', compact('crazyWriteHistory'));
    }

    public function edit($id)
    {
        $crazyWriteHistory = $this->repository->find($id);
        if (empty($crazyWriteHistory)) {
            session()->flash('error', 'not found');
            return back();
        }
        return view('en::admin.crazy-write-history.update', compact('crazyWriteHistory'));
    }

    public function update(CrazyWriteHistoryUpdateRequest $request, $id)
    {
        $input = $request->all();
        $crazyWriteHistory = $this->repository->find($id);
        if (empty($crazyWriteHistory)) {
            session()->flash('error', 'not found');
            return back();
        }
        $this->repository->change($input, $crazyWriteHistory);
        session()->flash('success', 'update success');
        return redirect()->route('crazy-write-histories.index');
    }

    public function destroy($id)
    {
        $crazyWriteHistory = $this->repository->find($id);
        if (empty($crazyWriteHistory)) {
            session()->flash('error', 'not found');
        }
        $this->repository->delete($id);
        session()->flash('success', 'delete success');
        return back();
    }
}
