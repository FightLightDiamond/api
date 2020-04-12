<?php

namespace English\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoryInterfaceExtra;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CrazyWriteHistoryRepository
 * @package namespace App\Repositories;
 */
interface CrazyWriteHistoryRepository extends RepositoryInterface, RepositoryInterfaceExtra
{
    public function myPaginate($input);

    public function store($input);

    public function change($input, $data);

    public function delete($data);

    public function import($file);
}
