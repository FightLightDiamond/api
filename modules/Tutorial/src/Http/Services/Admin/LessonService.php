<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 *
 */

namespace Tutorial\Http\Services\Admin;

use Tutorial\Http\Repositories\LessonRepository;

class LessonService
{
    private $repository;

    public function __construct(LessonRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index($input)
    {
        $input['{relationship}'] = null;
        $input['sort'] = 'id|desc';

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
        $lesson = $this->repository->find($id);

        return $this->repository->change($input, $lesson);
    }

    public function destroy($id)
    {
        $lesson = $this->repository->find($id);

        if (! empty($lesson)) {
            $this->repository->delete($id);
        }

        return $lesson;
    }
}
