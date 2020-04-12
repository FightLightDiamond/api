<?php

namespace English\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;

use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use English\Models\Similarity;

/**
 * Class NewsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class SimilarityRepositoryEloquent extends BaseRepository implements SimilarityRepository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Similarity::class;
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
        $input['created_by'] = auth()->id();
        $input = $this->standardized($input, $this->makeModel());
        return $this->create($input);
    }

    public function edit($id)
    {
        $Similarity = $this->find($id);
        if (empty($Similarity)) {
            return $Similarity;
        }
        return compact('Similarity');
    }

    public function change($input, $data)
    {
        $input['updated_by'] = auth()->id();
        $input = $this->standardized($input, $data);
        return $this->update($input, $data->id);
 }

    private function standardized($input, $data)
    {
        $input = $data->uploads($input);
        return $data->checkbox($input);
    }

    public function destroy($data)
    {
        return $this->delete($data->id);
    }

    /**
     * Boot up the repository, ping criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
