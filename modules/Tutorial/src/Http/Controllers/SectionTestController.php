<?php

namespace Tutorial\Http\Controllers;

use App\Http\Controllers\Controller;
use Cuongpm\Modularization\Facades\InputFa;
use Tutorial\Models\SectionTest;
use Tutorial\Http\Requests\SectionTestCreateRequest;
use Tutorial\Http\Requests\SectionTestUpdateRequest;
use Tutorial\Http\Repositories\SectionTestRepository;
use Illuminate\Http\Request;

class SectionTestController extends Controller
{
    private $repository;
    public function __construct(SectionTestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['sectionTests'] = $this->repository->myPaginate($input);
        if($request->ajax())
        {
            return view('tut::section-test.table', $data)->render();
        }
        return view('tut::section-test.index', $data);
    }

    public function create()
    {
        return view('tut::section-test.create');
    }

    public function store(SectionTestCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        session()->flash('success', 'create success');
        if(isset($input['is_back']))
        {
            return back();
        }
        return redirect()->route('section-test.index');
    }

    public function show($id)
    {
        $sectionTest = $this->repository->find($id);
        if(empty($sectionTest))
        {
            session()->flash('error', 'not found');
            return back();
        }
        return view('tut::section-test.show', compact('sectionTest'));
    }

    public function edit($id)
    {
        $sectionTest = $this->repository->find($id);
        if(empty($sectionTest))
        {
            session()->flash('error', 'not found');
            return back();
        }
        return view('tut::section-test.update', compact('sectionTest'));
    }

    public function update(SectionTestUpdateRequest $request, $id)
    {
        $input = $request->all();
        $sectionTest = $this->repository->find($id);
        if(empty($sectionTest))
        {
            session()->flash('error', 'not found');
            return back();
        }
        $this->repository->change($input, $sectionTest);
        session()->flash('success', 'update success');
        if(isset($input['is_back']))
        {
            return back();
        }
        return redirect()->route('section-test.index');
    }

    public function destroy($id)
    {
        $sectionTest = $this->repository->find($id);
        if(empty($sectionTest))
        {
            session()->flash('error', 'not found');
        }
        $this->repository->delete($id);
        session()->flash('success', 'delete success');
        return back();
    }
}
