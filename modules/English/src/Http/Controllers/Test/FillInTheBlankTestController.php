<?php

namespace English\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use English\Http\Repositories\FillInTheBlankRepository;
use Illuminate\Http\Request;

class FillInTheBlankTestController extends TestController
{
    public function __construct(FillInTheBlankRepository $repository)
    {
        $this->repository = $repository;
        $this->doView = 'en::test.fill-in-the-blank.do';
        $this->doneView = 'en::test.fill-in-the-blank.done';
    }
}
