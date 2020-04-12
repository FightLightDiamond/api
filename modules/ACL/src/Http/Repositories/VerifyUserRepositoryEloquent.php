<?php

namespace ACL\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;

use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ACL\Models\VerifyUser;

/**
 * Class NewsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class VerifyUserRepositoryEloquent extends BaseRepository implements VerifyUserRepository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return VerifyUser::class;
    }

    public function myPaginate($input)
    {
        isset($input['per_page']) ?: $input['per_page'] = 10;
        return $this->makeModel()
            ->filter($input)
            ->orderBy('id', 'DESC')
            ->paginate($input['per_page']);
    }

    public function store($input)
    {
        $input['created_by'] = auth()->id();
        return $this->create($input);
    }

    public function edit($id)
    {
        $verifyUser = $this->find($id);
        if (empty($verifyUser)) {
            return $verifyUser;
        }
        return compact('verifyUser');
    }

    public function change($input, $data)
    {
        $input['updated_by'] = auth()->id();
        return $this->update($input, $data->id);
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
