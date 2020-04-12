<?php

namespace English\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use English\Http\Requests\VocabularyCreateRequest;
use English\Http\Requests\VocabularyUpdateRequest;
use English\Http\Repositories\VocabularyRepository;
use Illuminate\Http\Request;

class VocabularyController extends Controller
{
    private $repository;

    public function __construct(VocabularyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['vocabularies'] = $this->repository->myPaginate($input);
        if ($request->ajax()) {
            return view('en::admin.vocabularies.table', $data)->render();
        }
        return view('en::admin.vocabularies.index', $data);
    }

    public function create()
    {
        return view('en::admin.vocabularies.create');
    }

    public function store(VocabularyCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        return redirect(route('admin.vocabularies.index'));
    }

    public function show($id)
    {
        $vocabulary = $this->repository->find($id);
        if (empty($vocabulary)) {
            session()->flash('error', 'Not Found');
            return back();
        }
        return view('en::admin.vocabularies.show', compact('vocabulary'));
    }

    public function edit($id)
    {
        $vocabulary = $this->repository->find($id);
        if (empty($vocabulary)) {
            session()->flash('error', 'Not Found');
            return back();
        }
        return view('en::admin.vocabularies.update', compact('vocabulary'));
    }

    public function update(VocabularyUpdateRequest $request, $id)
    {
        $input = $request->all();
        $vocabulary = $this->repository->find($id);
        if (empty($vocabulary)) {
            session()->flash('error', 'Not Found');
            return back();
        }
        $this->repository->change($input, $vocabulary);
        return redirect(route('admin.vocabularies.index'));
    }

    public function destroy($id)
    {
        $vocabulary = $this->repository->find($id);
        if (empty($vocabulary)) {
            session()->flash('error', 'Not Found');
            return back();
        }
        $this->repository->delete($id);
    }


    public function import(Request $request)
    {
        $file = $request->all()[0];
        $this->repository->import($file);
        if ($request->ajax()) {
            return response()->json('Import success');
        }
        session()->flash('success', 'Import success');
        return back();
    }

    public function export(Request $request)
    {
        $input = $request->all();
        $this->repository->export($input);
    }

}
