<?php

namespace English\Http\Controllers\API\Test;

use English\Http\Repositories\MistakeRepository;

class MistakeTestAPIController extends TestAPIController
{

    public function __construct(MistakeRepository $repository)
    {
        $this->repository = $repository;
        $this->doView = 'en::test.mistake.do';
        $this->doneView = 'en::test.mistake.done';
    }
}
