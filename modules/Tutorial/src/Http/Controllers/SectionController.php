<?php

namespace Tutorial\Http\Controllers;

use App\Http\Controllers\Controller;
use Cuongpm\Modularization\Facades\InputFa;
use Cuongpm\Modularization\MultiInheritance\ControllersTrait;
use Tutorial\Models\Section;
use Tutorial\Http\Requests\SectionCreateRequest;
use Tutorial\Http\Requests\SectionUpdateRequest;
use Tutorial\Http\Repositories\SectionRepository;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    private $repository;
    use ControllersTrait;
    public function __construct(SectionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['sections'] = $this->repository->myPaginate($input);
        if($request->ajax())
        {
            return view('tut::section.table', $data)->render();
        }
        return view('tut::section.index', $data);
    }

    public function create()
    {
        return view('tut::section.create');
    }

    public function store(SectionCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        session()->flash('success', 'create success');
        if(isset($input['is_back']))
        {
            return back();
        }
        return redirect()->route('section.index');
    }

    public function show($id)
    {
        $section = $this->repository->find($id);
        if(empty($section))
        {
            session()->flash('error', 'not found');
            return back();
        }
        return view('tut::section.show', compact('section'));
    }

    public function edit($id)
    {
        $data = $this->repository->edit($id);
        if(empty($data))
        {
            session()->flash('error', 'not found');
            return back();
        }
        if(isset($input['is_back']))
        {
            return back();
        }
        return view('tut::section.update', $data);

    }

    public function update(SectionUpdateRequest $request, $id)
    {
        $input = $request->all();
        $section = $this->repository->find($id);
        if(empty($section))
        {
            session()->flash('error', 'not found');
            return back();
        }
        $this->repository->change($input, $section);
        session()->flash('success', 'update success');
        if(isset($input['is_back']))
        {
            return back();
        }
        return redirect()->route('section.index');
    }

    public function destroy($id)
    {
        $this->repository->destroy($id);
        return back();
    }
}
