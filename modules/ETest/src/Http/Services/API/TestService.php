<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 *
 */

namespace ETest\Http\Services\API;

use ETest\Http\Repositories\TestRepository;

class TestService
{
    private $repository;

    public function __construct(TestRepository $repository)
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
        $test = $this->repository->find($id);

        return $this->repository->change($input, $test);
    }

    public function destroy($id)
    {
        $test = $this->repository->find($id);

		if (! empty($test)) {
            $this->repository->delete($id);
        }

        return $test;
    }
}
