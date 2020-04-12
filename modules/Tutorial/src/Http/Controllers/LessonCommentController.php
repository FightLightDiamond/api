<?php

namespace Tutorial\Http\Controllers;

use App\Http\Controllers\Controller;
use Tutorial\Http\Requests\LessonCommentCreateRequest;
use Tutorial\Http\Requests\LessonCommentUpdateRequest;
use Tutorial\Http\Repositories\LessonCommentRepository;
use Illuminate\Http\Request;

class LessonCommentController extends Controller
{
    private $repository;
    public function __construct(LessonCommentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['lessonComments'] = $this->repository->myPaginate($input);
        if($request->ajax())
        {
            return view('tut::lesson-comment.table', $data)->render();
        }
        return view('tut::lesson-comment.index', $data);
    }

    public function create()
    {
        return view('tut::lesson-comment.create');
    }

    public function store(LessonCommentCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);

        if($request->ajax()) {
            return response()->json($input);
        }

        session()->flash('success', 'create success');

        if(isset($input['is_back']))
        {
            return back();
        }

        return redirect()->route('lesson-comment.index');
    }

    public function show($id)
    {
        $lessonComment = $this->repository->find($id);
        if(empty($lessonComment))
        {
            session()->flash('error', 'not found');
            return back();
        }
        return view('tut::lesson-comment.show', compact('lessonComment'));
    }

    public function edit($id)
    {
        $lessonComment = $this->repository->find($id);
        if(empty($lessonComment))
        {
            session()->flash('error', 'not found');
            return back();
        }
        return view('tut::lesson-comment.update', compact('lessonComment'));
    }

    public function update(LessonCommentUpdateRequest $request, $id)
    {
        $input = $request->all();
        $lessonComment = $this->repository->find($id);
        if(empty($lessonComment))
        {
            session()->flash('error', 'not found');
            return back();
        }
        $this->repository->change($input, $lessonComment);
        session()->flash('success', 'update success');
        if(isset($input['is_back']))
        {
            return back();
        }
        return redirect()->route('lesson-comment.index');
    }

    public function destroy($id)
    {
        $lessonComment = $this->repository->find($id);
        if(empty($lessonComment))
        {
            session()->flash('error', 'not found');
        }
        $this->repository->delete($id);
        session()->flash('success', 'delete success');
        return back();
    }
}
