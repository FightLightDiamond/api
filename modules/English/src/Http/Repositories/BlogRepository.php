<?php

namespace English\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoryInterfaceExtra;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BlogRepository
 * @package namespace App\Repositories;
 */
interface BlogRepository extends RepositoryInterface, RepositoryInterfaceExtra
{
    public function myPaginate($input);

    public function store($input);

    public function change($input, $data);

    public function delete($data);

    public function import($file);
}
