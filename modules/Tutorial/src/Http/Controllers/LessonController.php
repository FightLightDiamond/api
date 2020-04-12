<?php

namespace Tutorial\Http\Controllers;

use App\Http\Controllers\Controller;
use Cuongpm\Modularization\Facades\InputFa;
use Tutorial\Http\Requests\LessonCreateRequest;
use Tutorial\Http\Requests\LessonUpdateRequest;
use Tutorial\Http\Repositories\LessonRepository;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    private $repository;
//    use ControllersTrait;
    public function __construct(LessonRepository $repository)
    {
        $this->repository = $repository;
    }
    public function lists(Request $request) {
        $input = $request->all();
        return $this->repository->filterList($input, 'title');
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['lessons'] = $this->repository->myPaginate($input);
        if($request->ajax())
        {
            return view('tut::lesson.table', $data)->render();
        }
        return view('tut::lesson.index', $data);
    }

    public function create()
    {
        return view('tut::lesson.create');
    }

    public function store(LessonCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        session()->flash('success', 'create success');
        if(isset($input['is_back']))
        {
            return back();
        }
        return redirect()->route('lesson.index');
    }

    public function show($id)
    {
        $lesson = $this->repository->find($id);
        if(empty($lesson))
        {
            session()->flash('error', 'not found');
            return back();
        }
        return view('tut::lesson.show', compact('lesson'));
    }

    public function edit($id)
    {
        $data = $this->repository->edit($id);
        if(empty($data))
        {
            session()->flash('error', 'not found');
            return back();
        }
        return view('tut::lesson.update', $data);
    }

    public function update(LessonUpdateRequest $request, $id)
    {
        $input = $request->all();
        $lesson = $this->repository->find($id);
        if(empty($lesson))
        {
            session()->flash('error', 'not found');
            return back();
        }
        $this->repository->change($input, $lesson);
        session()->flash('success', 'update success');
        if(isset($input['is_back']))
        {
            return back();
        }
        return redirect()->route('lesson.index');
    }

    public function destroy($id)
    {
        $lesson = $this->repository->find($id);
        if(empty($lesson))
        {
            session()->flash('error', 'not found');
        }
        $this->repository->delete($id);
        session()->flash('success', 'delete success');
        return back();
    }
}
