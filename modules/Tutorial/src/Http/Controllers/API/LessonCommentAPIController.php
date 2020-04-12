<?php

namespace Tutorial\Http\Controllers\API;

use Tutorial\Http\Resources\LessonCommentResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tutorial\Models\LessonComment;
use Tutorial\Http\Repositories\LessonCommentRepository;

class LessonCommentAPIController extends Controller
{
    private $repository;
    public function __construct(LessonCommentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $input = $request->all();
        $comments = LessonComment::orderBy('id', 'DESC')
            ->filter($input)
            ->simplePaginate();
        return LessonCommentResource::collection($comments);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $input = $request->all();

        if(auth()->check()) {
            $comment = $this->repository->store($input);
            if($comment) {
                return response(new LessonCommentResource($comment), 200);
            }
        }
        return response(false, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = LessonComment::findOrfail($id);

        // Return a single task
        return new LessonCommentResource($comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = LessonComment::findOrfail($id);

        if($comment->delete()) {
            return new LessonCommentResource($comment);
        }
    }
}
