<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 *
 */

namespace English\Http\Services\API;

use English\Http\Repositories\CrazySpeakHistoryRepository;

class CrazySpeakHistoryService
{
    private $repository;

    public function __construct(CrazySpeakHistoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index($input)
    {
        $input['{relationship}'] = ['crazy:id,name,crazy_course_id', 'crazy.crazyCourse:id,name'];
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
        $crazySpeakHistory = $this->repository->find($id);

        return $this->repository->change($input, $crazySpeakHistory);
    }

    public function destroy($id)
    {
        $crazySpeakHistory = $this->repository->find($id);

		if (! empty($crazySpeakHistory)) {
            $this->repository->delete($id);
        }

        return $crazySpeakHistory;
    }
}
