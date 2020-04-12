<?php

namespace English\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use English\Http\Requests\PronunciationCreateRequest;
use English\Http\Requests\PronunciationUpdateRequest;
use English\Http\Repositories\PronunciationRepository;
use Illuminate\Http\Request;
use Cuongpm\Modularization\MultiInheritance\ControllersTrait;

class PronunciationController extends Controller
{
    use ControllersTrait;
    private $repository;

    public function __construct(PronunciationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['pronunciations'] = $this->repository->myPaginate($input);
        if ($request->ajax()) {
            return view('en::admin.pronunciation.table', $data)->render();
        }
        return view('en::admin.pronunciation.index', $data);
    }

    public function create()
    {
        return view('en::admin.pronunciation.create');
    }

    public function store(PronunciationCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        session()->flash('success', 'create success');
        return redirect()->route('admin.pronunciations.index');
    }

    public function show($id)
    {
        $pronunciation = $this->repository->find($id);
        if (empty($pronunciation)) {
            session()->flash('error', 'not found');
            return back();
        }
        return view('en::admin.pronunciation.show', compact('pronunciation'));
    }

    public function edit($id)
    {
        $pronunciation = $this->repository->find($id);
        if (empty($pronunciation)) {
            session()->flash('error', 'not found');
            return back();
        }
        return view('en::admin.pronunciation.update', compact('pronunciation'));
    }

    public function update(PronunciationUpdateRequest $request, $id)
    {
        $input = $request->all();
        $pronunciation = $this->repository->find($id);
        if (empty($pronunciation)) {
            session()->flash('error', 'not found');
            return back();
        }
        $this->repository->change($input, $pronunciation);
        session()->flash('success', 'update success');
        return redirect()->route('admin.pronunciations.index');
    }

    public function destroy($id)
    {
        $pronunciation = $this->repository->find($id);
        if (empty($pronunciation)) {
            session()->flash('error', 'not found');
        }
        $this->repository->delete($id);
        session()->flash('success', 'delete success');
        return back();
    }
}
