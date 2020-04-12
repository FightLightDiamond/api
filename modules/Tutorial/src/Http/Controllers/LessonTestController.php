<?php

namespace Tutorial\Http\Controllers;

use App\Http\Controllers\Controller;
use Cuongpm\Modularization\MultiInheritance\ControllersTrait;
use Tutorial\Http\Requests\LessonTestCreateRequest;
use Tutorial\Http\Requests\LessonTestUpdateRequest;
use Tutorial\Http\Repositories\LessonTestRepository;
use Illuminate\Http\Request;

class LessonTestController extends Controller
{
    use ControllersTrait;
    private $repository;
    public function __construct(LessonTestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['lessonTests'] = $this->repository->myPaginate($input);
        if($request->ajax())
        {
            return view('tut::lesson-test.table', $data)->render();
        }
        return view('tut::lesson-test.index', $data);
    }

    public function create()
    {
        return view('tut::lesson-test.create');
    }

    public function store(LessonTestCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        if(isset($input['is_back']))
        {
            return back();
        }
        session()->flash('success', 'create success');
        return redirect()->route('lesson-test.index');
    }

    public function show($id)
    {
        $lessonTest = $this->repository->find($id);
        if(empty($lessonTest))
        {
            session()->flash('error', 'not found');
            return back();
        }
        return view('tut::lesson-test.show', compact('lessonTest'));
    }


    public function edit($id)
    {
        try {
            $data = $this->repository->edit($id);
        } catch (\Exception $exception) {
            session()->flash('error', $exception);
            return redirect()->route('home');
        }

        return view('tut::lesson-test.update', $data);
    }

    public function update(LessonTestUpdateRequest $request, $id)
    {
        $input = $request->all();
        $lessonTest = $this->repository->find($id);
        if(empty($lessonTest))
        {
            session()->flash('error', 'not found');
            return back();
        }
        $this->repository->change($input, $lessonTest);
        if(isset($input['is_back']))
        {
            return back();
        }
        session()->flash('success', 'update success');
        return redirect()->route('lesson-test.index');
    }

    public function destroy($id)
    {
        $lessonTest = $this->repository->find($id);
        if(empty($lessonTest))
        {
            session()->flash('error', 'not found');
        }
        $this->repository->delete($id);
        session()->flash('success', 'delete success');
        return back();
    }
}
