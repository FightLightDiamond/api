<?php

namespace Tutorial\Http\Controllers;

use App\Http\Controllers\Controller;
use Cuongpm\Modularization\Facades\InputFa;
use Tutorial\Http\Requests\TutorialTestCreateRequest;
use Tutorial\Http\Requests\TutorialTestUpdateRequest;
use Tutorial\Http\Repositories\TutorialTestRepository;
use Illuminate\Http\Request;

class TutorialTestController extends Controller
{
    private $repository;
    public function __construct(TutorialTestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['tutorialTests'] = $this->repository->myPaginate($input);
        if($request->ajax())
        {
            return view('tut::tutorial-test.table', $data)->render();
        }
        return view('tut::tutorial-test.index', $data);
    }

    public function create()
    {
        return view('tut::tutorial-test.create');
    }

    public function store(TutorialTestCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        session()->flash('success', 'create success');
        if(isset($input['is_back']))
        {
            return back();
        }
        return redirect()->route('tutorial-test.index');
    }

    public function show($id)
    {
        $tutorialTest = $this->repository->find($id);
        if(empty($tutorialTest))
        {
            session()->flash('error', 'not found');
            return back();
        }
        return view('tut::tutorial-test.show', compact('tutorialTest'));
    }

    public function edit($id)
    {
        $tutorialTest = $this->repository->find($id);
        if(empty($tutorialTest))
        {
            session()->flash('error', 'not found');
            return back();
        }
        if(isset($input['is_back']))
        {
            return back();
        }
        return view('tut::tutorial-test.update', compact('tutorialTest'));
    }

    public function update(TutorialTestUpdateRequest $request, $id)
    {
        $input = $request->all();
        $tutorialTest = $this->repository->find($id);
        if(empty($tutorialTest))
        {
            session()->flash('error', 'not found');
            return back();
        }
        $this->repository->change($input, $tutorialTest);
        if(isset($input['is_back']))
        {
            return back();
        }
        session()->flash('success', 'update success');
        return redirect()->route('tutorial-test.index');
    }

    public function destroy($id)
    {
        $tutorialTest = $this->repository->find($id);
        if(empty($tutorialTest))
        {
            session()->flash('error', 'not found');
        }
        $this->repository->delete($id);
        session()->flash('success', 'delete success');
        return back();
    }
}
