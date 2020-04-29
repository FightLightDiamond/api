<?php

namespace English\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoryInterfaceExtra;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CrazyListenHistoryRepository
 * @package namespace App\Repositories;
 */
interface CrazyListenHistoryRepository extends RepositoryInterface, RepositoryInterfaceExtra
{
    public function myPaginate($input);

    public function store($input);

    public function change($input, $data);

    public function delete($data);

    public function import($file);
}
