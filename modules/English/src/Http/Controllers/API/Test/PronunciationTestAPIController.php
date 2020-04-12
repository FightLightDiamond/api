<?php

namespace English\Http\Controllers\API\Test;

use App\Http\Controllers\Controller;
use English\Http\Repositories\PronunciationRepository;
use Illuminate\Http\Request;

class PronunciationTestAPIController extends TestAPIController
{
    public function __construct(PronunciationRepository $repository)
    {
        $this->repository = $repository;
        $this->doView = 'en::test.pronunciation.do';
        $this->doneView = 'en::test.pronunciation.done';
    }
}
