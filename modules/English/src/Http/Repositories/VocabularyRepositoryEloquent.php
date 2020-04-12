<?php

namespace English\Http\Repositories;

use English\Models\Vocabulary;
use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;
use Maatwebsite\Excel\Facades\Excel;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class VocabularyRepositoryEloquent
 * @package namespace App\Repositories;
 */
class VocabularyRepositoryEloquent extends BaseRepository implements VocabularyRepository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Vocabulary::class;
    }

    public function myPaginate($input)
    {
        isset($input[PER_PAGE]) ?: $input[PER_PAGE] = 10;
        return $this->makeModel()
            ->filter($input)
            ->orders(isset($input['orderBy']) ? $input['orderBy'] : [ 'id' => 'DESC' ])
            ->paginate($input[PER_PAGE]);
    }

    public function store($input)
    {
        $input = $this->standardized($input, $this->makeModel());
        $this->create($input);
    }

    public function change($input, $vocabulary)
    {
        $input = $this->standardized($input, $vocabulary);
        return $this->update($input, $vocabulary->id);
    }

    public function destroy($data)
    {
        // TODO: Implement destroy() method.
    }

    private function standardized($input, $vocabulary)
    {
        $input = $vocabulary->uploads($input);
        return $vocabulary->checkbox($input);
    }


    public function export($input)
    {
        $data = $this->makeModel()
            ->filter($input)
            ->limit(9999)
            ->get();

        Excel::create('file', function ($excel) use ($data) {
            $excel->setTitle('Vocabulary');
            $excel->setCreator('Fight Light Diamond')->setCompany('Conquer');
           // $excel->setDescr
        });
    }
    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
