<?php

namespace English\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $repository, $doView, $doneView;

    public function index(Request $request) {
        $input = $request->all();
        $input['orderBy'] = [ 'id' => 'ASC' ];

        $questions = $this->repository->myPaginate($input);

        return view($this->doView, compact('questions'));
    }

    public function done(Request $request) {
        $input = $request->all();
        $page = $request->get('page');
        $replies = $request->except(['_token']);
        $input['orderBy'] = [ 'id' => 'ASC' ];

        $questions = $this->repository->myPaginate($input);
        $score = 0;
        $exactly = [];
        $questionCount = count($questions);

        foreach ($questions as $question) {
            $answerKey = 'answer' . $question->id;
            $exactly[$question->id] = false;

            if (isset($input[$answerKey])) {
                if ($question->answer ==  $input[$answerKey]) {
                    ++$score;
                    $exactly[$question->id] = true;
                }
            }
        }

        session()->flash('success', "Bạn trả lời đúng {$score}/{$questionCount} câu hỏi");

        return view($this->doneView, compact('questions', 'exactly', 'replies', 'page'));
    }
}
