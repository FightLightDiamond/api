<?php

namespace English\Http\Controllers\Test;

use English\Http\Repositories\CrazyRepository;
use English\Http\Services\CrazyTestService;
use Illuminate\Http\Request;

class CrazyTestController
{
    private $repository, $doView, $doneView, $service;

    public function __construct(CrazyRepository $repository, CrazyTestService $service)
    {
        $this->repository = $repository;
        $this->doView = 'en::test.crazy.reading';
        $this->doneView = 'en::test.crazy.read';
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $input['orderBy'] = ['id' => 'ASC'];
        $questions = $this->repository->myPaginate($input);
        return view($this->doView, compact('questions'));
    }

    public function reading($id)
    {
        $data = $this->service->reading($id);
        $data['routeName'] = 'test.crazy.reading';

        return view($this->doView, $data);
    }

    public function read($id)
    {
        $sentences = request('sentences');
        $meanings = request('meanings');

        $data = $this->service->read($id, $sentences, $meanings);

        if (empty($data)) {
            session()->flash('error', 'Lesson not found');
            return redirect()->route('home');
        }

        session()->flash('success', "Bạn làm đúng {$data['score']} câu");

        return view($this->doneView, $data);
    }

    public function writing($id)
    {
        $data = $this->service->writing($id);
        $data['routeName'] = 'test.crazy.writing';
        return view('en::test.crazy.writing', $data);
    }

    public function written($id)
    {
        $sentences = request('sentences');
        $meanings = request('meanings');
        $data = $this->service->written($id, $sentences);
        if (empty($data)) {
            session()->flash('error', 'Lesson not found');
            return redirect()->route('home');
        }
        session()->flash('success', "Bạn làm đúng {$data['score']} câu");
        return view('en::test.crazy.written', $data)->with(compact('sentences', 'meanings'));
    }
}
