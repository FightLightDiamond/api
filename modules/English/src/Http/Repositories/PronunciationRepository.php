<?php

namespace English\Http\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface NewsRepository
 * @package namespace App\Repositories;
 */
interface PronunciationRepository extends RepositoryInterface
{
    public function myPaginate($input);

    public function store($input);

    public function change($input, $data);

    public function delete($data);
}