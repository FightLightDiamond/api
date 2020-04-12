<?php

namespace Tutorial\Http\Controllers;

use App\Http\Controllers\Controller;
use Cuongpm\Modularization\Facades\InputFa;
use Tutorial\Models\TutorialResult;
use Tutorial\Http\Requests\TutorialResultCreateRequest;
use Tutorial\Http\Requests\TutorialResultUpdateRequest;
use Tutorial\Http\Repositories\TutorialResultRepository;
use Illuminate\Http\Request;

class TutorialResultController extends Controller
{
    private $repository;
    public function __construct(TutorialResultRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['tutorialResults'] = $this->repository->myPaginate($input);
        if($request->ajax())
        {
            return view('tut::tutorial-result.table', $data)->render();
        }
        return view('tut::tutorial-result.index', $data);
    }

    public function create()
    {
        return view('tut::tutorial-result.create');
    }

    public function store(TutorialResultCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        session()->flash('success', 'create success');
        if(isset($input['is_back']))
        {
            return back();
        }
        return redirect()->route('tutorial-result.index');
    }

    public function show($id)
    {
        $tutorialResult = $this->repository->find($id);
        if(empty($tutorialResult))
        {
            session()->flash('error', 'not found');
            return back();
        }
        return view('tut::tutorial-result.show', compact('tutorialResult'));
    }

    public function edit($id)
    {
        $tutorialResult = $this->repository
            ->with(['creator:id,email', 'tutorial:id,name'])
            ->find($id);
        dump($tutorialResult);
        if(empty($tutorialResult))
        {
            session()->flash('error', 'not found');
            return back();
        }
        return view('tut::tutorial-result.update', compact('tutorialResult'));
    }

    public function update(TutorialResultUpdateRequest $request, $id)
    {
        $input = $request->all();
        $tutorialResult = $this->repository->find($id);
        if(empty($tutorialResult))
        {
            session()->flash('error', 'not found');
            return back();
        }
        $this->repository->change($input, $tutorialResult);
        session()->flash('success', 'update success');
        if(isset($input['is_back']))
        {
            return back();
        }
        return redirect()->route('tutorial-result.index');
    }

    public function destroy($id)
    {
        $tutorialResult = $this->repository->find($id);
        if(empty($tutorialResult))
        {
            session()->flash('error', 'not found');
        }
        $this->repository->delete($id);
        session()->flash('success', 'delete success');
        return back();
    }
}
