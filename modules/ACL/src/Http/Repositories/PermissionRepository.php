<?php

namespace ACL\Http\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PermissionRepository
 * @package namespace App\Repositories;
 */
interface PermissionRepository extends RepositoryInterface
{
    public function myPaginate($input);
    public function store($input);
    public function change($input, $data);
    public function destroy($data);
    public function is($name);
    public function access($module_id, $access_id);
    public function accesses($module_id, $access_ids);
}
