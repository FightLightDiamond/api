<?php

namespace English\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Cuongpm\Modularization\Facades\InputFa;
use English\Models\Mistake;
use English\Http\Requests\MistakeCreateRequest;
use English\Http\Requests\MistakeUpdateRequest;
use English\Http\Repositories\MistakeRepository;
use Illuminate\Http\Request;
use Cuongpm\Modularization\MultiInheritance\ControllersTrait;

class MistakeController extends Controller
{
    use ControllersTrait;
    private $repository;
    public function __construct(MistakeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['mistakes'] = $this->repository->myPaginate($input);
        if($request->ajax())
        {
            return view('en::admin.mistake.table', $data)->render();
        }
        return view('en::admin.mistake.index', $data);
    }

    public function create()
    {
        return view('en::admin.mistake.create');
    }

    public function store(MistakeCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        session()->flash('success', 'create success');
        return redirect()->route('admin.mistakes.index');
    }

    public function show($id)
    {
        $mistake = $this->repository->find($id);
        if(empty($mistake))
        {
            session()->flash('error', 'not found');
            return back();
        }
        return view('en::admin.mistake.show', compact('mistake'));
    }

    public function edit($id)
    {
        $mistake = $this->repository->find($id);
        if(empty($mistake))
        {
            session()->flash('error', 'not found');
            return back();
        }
        return view('en::admin.mistake.update', compact('mistake'));
    }

    public function update(MistakeUpdateRequest $request, $id)
    {
        $input = $request->all();
        $mistake = $this->repository->find($id);
        if(empty($mistake))
        {
            session()->flash('error', 'not found');
            return back();
        }
        $this->repository->change($input, $mistake);
        session()->flash('success', 'update success');
        return redirect()->route('admin.mistakes.index');
    }

    public function destroy($id)
    {
        $mistake = $this->repository->find($id);
        if(empty($mistake))
        {
            session()->flash('error', 'not found');
        }
        $this->repository->delete($id);
        session()->flash('success', 'delete success');
        return back();
    }
}
