<?php

namespace Tutorial\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoryInterfaceExtra;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserTutorialRepository
 * @package namespace App\Repositories;
 */
interface UserTutorialRepository extends RepositoryInterface, RepositoryInterfaceExtra
{
    public function myPaginate($input);

    public function store($input);

    public function change($input, $data);

    public function delete($data);

    public function import($file);
}
