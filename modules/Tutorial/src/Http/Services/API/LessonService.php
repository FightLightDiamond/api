<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 *
 */

namespace Tutorial\Http\Services\API;

use Illuminate\Support\Facades\Auth;
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

    public function store($input)
    {
        $input['created_by'] = \auth('api')->id();
        return $this->repository->store($input);
    }

    public function show($id)
    {
        $relation = [
            'section',
            'section.tutorial.sections:id,tutorial_id,name',
            'section.lessons:id,section_id,title'
        ];

        return $this->repository->with($relation)->find($id);
    }

    public function edit($id)
    {
        return $this->repository->find($id);
    }

    public function update($input, $id)
    {
        $lesson = $this->repository->find($id);
        $input['updated_at'] = \auth('api')->id();
        return $this->repository->change($input, $lesson);
    }

    public function destroy($id)
    {
        $lesson = $this->repository->find($id);

        if (!empty($lesson)) {
            $this->repository->delete($id);
        }

        return $lesson;
    }
}
