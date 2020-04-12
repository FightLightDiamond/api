<?php

namespace English\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use English\Http\Repositories\PronunciationRepository;
use Illuminate\Http\Request;

class PronunciationTestController extends TestController
{
    public function __construct(PronunciationRepository $repository)
    {
        $this->repository = $repository;
        $this->doView = 'en::test.pronunciation.do';
        $this->doneView = 'en::test.pronunciation.done';
    }
}
