<?php

namespace English\Http\Controllers\Test;

use English\Http\Repositories\MistakeRepository;

class MistakeTestController extends TestController
{

    public function __construct(MistakeRepository $repository)
    {
        $this->repository = $repository;
        $this->doView = 'en::test.mistake.do';
        $this->doneView = 'en::test.mistake.done';
    }
}
