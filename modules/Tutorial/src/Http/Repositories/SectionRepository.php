<?php

namespace Tutorial\Http\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface NewsRepository
 * @package namespace App\Repositories;
 */
interface SectionRepository extends RepositoryInterface
{
    public function myPaginate($input);
    public function store($input);
    public function change($input, $data);
    public function destroy($id);
    public function edit($id);
}