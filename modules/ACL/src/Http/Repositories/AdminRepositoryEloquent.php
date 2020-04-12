<?php

namespace ACL\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ACL\Models\Admin;

/**
 * ClassAdminRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AdminRepositoryEloquent extends BaseRepository implements AdminRepository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Admin::class;
    }

    public function myPaginate($input)
    {
        isset($input['per_page']) ?: $input['per_page'] = 10;

        return $this->makeModel()
            ->filter($input)
            ->paginate($input['per_page']);
    }

    public function store($input)
    {
        return $this->create($input);
    }

    public function edit($id)
    {
        $admin = $this->find($id);

        if (empty($admin)) {
            return $admin;
        }

        return compact('admin');
    }

    public function change($input, $data)
    {
        return $this->update($input, $data->id);
    }

    public function import($file)
    {
        set_time_limit(9999);
        $path = $this->makeModel()->uploadImport($file);

        return $this->importing($path);
    }

    private function standardized($input, $data)
    {
        return $data->uploads($input);
    }

    public function destroy($data)
    {
        return $this->delete($data->id);
    }

    /**
     * Boot up the repository, ping criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
