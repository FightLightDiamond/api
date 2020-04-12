<?php

namespace Tutorial\Http\Controllers;

use App\Http\Controllers\Controller;
use Cuongpm\Modularization\Facades\InputFa;
use Tutorial\Models\SectionResult;
use Tutorial\Http\Requests\SectionResultCreateRequest;
use Tutorial\Http\Requests\SectionResultUpdateRequest;
use Tutorial\Http\Repositories\SectionResultRepository;
use Illuminate\Http\Request;

class SectionResultController extends Controller
{
    private $repository;
    public function __construct(SectionResultRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['sectionResults'] = $this->repository->myPaginate($input);
        if($request->ajax())
        {
            return view('tut::section-result.table', $data)->render();
        }
        return view('tut::section-result.index', $data);
    }

    public function create()
    {
        return view('tut::section-result.create');
    }

    public function store(SectionResultCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        session()->flash('success', 'create success');
        if(isset($input['is_back']))
        {
            return back();
        }
        return redirect()->route('section-result.index');
    }

    public function show($id)
    {
        $sectionResult = $this->repository->find($id);
        if(empty($sectionResult))
        {
            session()->flash('error', 'not found');
            return back();
        }
        return view('tut::section-result.show', compact('sectionResult'));
    }

    public function edit($id)
    {
        $sectionResult = $this->repository->find($id);
        if(empty($sectionResult))
        {
            session()->flash('error', 'not found');
            return back();
        }
        return view('tut::section-result.update', compact('sectionResult'));
    }

    public function update(SectionResultUpdateRequest $request, $id)
    {
        $input = $request->all();
        $sectionResult = $this->repository->find($id);
        if(empty($sectionResult))
        {
            session()->flash('error', 'not found');
            return back();
        }
        $this->repository->change($input, $sectionResult);
        session()->flash('success', 'update success');
        if(isset($input['is_back']))
        {
            return back();
        }
        return redirect()->route('section-result.index');
    }

    public function destroy($id)
    {
        $sectionResult = $this->repository->find($id);
        if(empty($sectionResult))
        {
            session()->flash('error', 'not found');
        }
        $this->repository->delete($id);
        session()->flash('success', 'delete success');
        return back();
    }
}
