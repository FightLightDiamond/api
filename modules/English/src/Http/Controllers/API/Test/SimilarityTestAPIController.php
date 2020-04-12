<?php

namespace English\Http\Controllers\API\Test;

use English\Http\Repositories\SimilarityRepository;

class SimilarityTestAPIController extends TestAPIController
{
    public function __construct(SimilarityRepository $repository)
    {
        $this->repository = $repository;
        $this->doView = 'en::test.similarity.do';
        $this->doneView = 'en::test.similarity.done';
    }
}
