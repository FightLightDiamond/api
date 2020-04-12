<?php

namespace English\Http\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface VocabularyRepository
 * @package namespace App\Repositories;
 */
interface VocabularyRepository extends RepositoryInterface
{
    public function myPaginate($input);
    public function store($input);
    public function change($input, $data);
    public function destroy($data);
}
