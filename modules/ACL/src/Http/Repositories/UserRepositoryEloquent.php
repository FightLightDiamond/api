<?php

namespace ACL\Http\Repositories;

use App\User;
use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;


/**
 * Class UserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
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
        $input = $this->standardized($input, $this->makeModel());
        $user = $this->create($input);
        return $user;
    }

    public function change($input, $data)
    {
        $input = $this->standardized($input, $data);
        $user = $this->update($input, $data->id);

        return $user;
    }

    public function destroy($data)
    {
        return $this->delete($data->id);
        // TODO: Implement destroy() method.
    }

    private function standardized($input, $data)
    {
        return $data->uploader($input);
    }

    /**
     * Boot up the repository, ping criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
