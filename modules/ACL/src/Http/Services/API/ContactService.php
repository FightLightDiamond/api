<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 *
 */

namespace ACL\Http\Services\API;

use ACL\Http\Repositories\ContactRepository;

class ContactService
{
    private $repository;

    public function __construct(ContactRepository $repository)
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
        $contact = $this->repository->find($id);

        return $this->repository->change($input, $contact);
    }

    public function destroy($id)
    {
        $contact = $this->repository->find($id);

		if (! empty($contact)) {
            $this->repository->delete($id);
        }

        return $contact;
    }
}
