<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 *
 */

namespace ACL\Http\Services\API;

use ACL\Http\Repositories\AdminRepository;

class AdminService
{
    private $repository;

    public function __construct(AdminRepository $repository)
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
        $admin = $this->repository->find($id);

        return $this->repository->change($input, $admin);
    }

    public function destroy($id)
    {
        $admin = $this->repository->find($id);

		if (! empty($admin)) {
            $this->repository->delete($id);
        }

        return $admin;
    }
}
