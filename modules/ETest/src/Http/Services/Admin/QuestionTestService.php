<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 *
 */

namespace ETest\Http\Services\Admin;

use ETest\Http\Repositories\QuestionTestRepository;

class QuestionTestService
{
    private $repository;

    public function __construct(QuestionTestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index($input)
    {
        $input[RELATIONSHIP_FILTER] = null;
        $input[SORT_FILTER] = 'id|desc';

        return $this->repository->myPaginate($input);
    }

    public function create()
    {
        return [];
    }

    public function store($input)
    {
        return $this->repository->store($input);
    }

    public function show($id)
    {
       return $this->repository->find($id);
    }

    public function edit($id)
    {
       return $this->repository->find($id);
    }

    public function update($input, $id)
    {
        $questionTest = $this->repository->find($id);

        return $this->repository->change($input, $questionTest);
    }

    public function destroy($id)
    {
        $questionTest = $this->repository->find($id);

        if (! empty($questionTest)) {
            $this->repository->delete($id);
        }

        return $questionTest;
    }
}
