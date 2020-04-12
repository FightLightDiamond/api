<?php

namespace ACL\Http\Repositories;

use Illuminate\Support\Facades\DB;
use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ACL\Models\Role;

/**
 * Class RoleRepositoryEloquent
 * @package namespace App\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    use RepositoriesTrait;
    protected $checkbox = ['is_active'];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    public function myPaginate($input)
    {
        return $this->paginate(10);
    }

    public function store($input)
    {
        $this->create($input);
    }

    public function change($input, $id)
    {
        $this->update($input, $id);
    }

    public function destroy($input)
    {
        $this->delete($input);
    }

    public function destroys($input)
    {
        $this->findWhereIn('id', $input)->delete();
    }


    public function is($name)
    {
        if ($name === 'admin') {
            return auth('admin')->check();
        }
        $name = explode('|', $name);
        $user_id = auth()->id();
        $roleIs = $this->makeModel()
            ->whereIn('name', $name)
            ->pluck('id')->toArray();
        if (count($roleIs) === 0) {
            return false;
        }
        $count = DB::table('role_user')
            ->where('user_id', $user_id)
            ->whereIn('role_id', $roleIs)
            ->count();
        if ($count > 0) {
            return true;
        }
        return false;
    }

    /**
     * Boot up the repository, ping criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
