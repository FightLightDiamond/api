<?php

namespace English\Http\Controllers\Test;

use English\Http\Repositories\SimilarityRepository;

class SimilarityTestController extends TestController
{
    public function __construct(SimilarityRepository $repository)
    {
        $this->repository = $repository;
        $this->doView = 'en::test.similarity.do';
        $this->doneView = 'en::test.similarity.done';
    }
}
