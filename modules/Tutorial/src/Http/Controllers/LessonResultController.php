<?php

namespace Tutorial\Http\Controllers;

use App\Http\Controllers\Controller;
use Cuongpm\Modularization\Facades\InputFa;
use Tutorial\Models\LessonResult;
use Tutorial\Http\Requests\LessonResultCreateRequest;
use Tutorial\Http\Requests\LessonResultUpdateRequest;
use Tutorial\Http\Repositories\LessonResultRepository;
use Illuminate\Http\Request;

class LessonResultController extends Controller
{
    private $repository;
    public function __construct(LessonResultRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['lessonResults'] = $this->repository->myPaginate($input);
        if($request->ajax())
        {
            return view('tut::lesson-result.table', $data)->render();
        }
        return view('tut::lesson-result.index', $data);
    }

    public function create()
    {
        return view('tut::lesson-result.create');
    }

    public function store(LessonResultCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        session()->flash('success', 'create success');
        if(isset($input['is_back']))
        {
            return back();
        }
        return redirect()->route('lesson-result.index');
    }

    public function show($id)
    {
        $lessonResult = $this->repository->find($id);
        if(empty($lessonResult))
        {
            session()->flash('error', 'not found');
            return back();
        }
        return view('tut::lesson-result.show', compact('lessonResult'));
    }

    public function edit($id)
    {
        $lessonResult = $this->repository->makeModel()
            ->with('lessons:id,title')
            ->find($id);
        if(empty($lessonResult))
        {
            session()->flash('error', 'not found');
            return back();
        }

        return view('tut::lesson-result.update', compact('lessonResult'));
    }

    public function update(LessonResultUpdateRequest $request, $id)
    {
        $input = $request->all();
        $lessonResult = $this->repository->find($id);
        if(empty($lessonResult))
        {
            session()->flash('error', 'not found');
            return back();
        }
        $this->repository->change($input, $lessonResult);
        session()->flash('success', 'update success');
        if(isset($input['is_back']))
        {
            return back();
        }
        return redirect()->route('lesson-result.index');
    }

    public function destroy($id)
    {
        $lessonResult = $this->repository->find($id);
        if(empty($lessonResult))
        {
            session()->flash('error', 'not found');
        }
        $this->repository->delete($id);
        session()->flash('success', 'delete success');
        return back();
    }
}
