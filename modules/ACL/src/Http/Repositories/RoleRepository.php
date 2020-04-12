<?php

namespace ACL\Http\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RoleRepository
 * @package namespace App\Repositories;
 */
interface RoleRepository extends RepositoryInterface
{
    public function myPaginate($input);
    public function store($input);
    public function change($input, $data);
    public function destroy($data);
    public function is($name);
}
