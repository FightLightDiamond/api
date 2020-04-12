<?php

namespace Tutorial\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;

use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Tutorial\Models\TutorialTest;

/**
 * Class NewsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TutorialTestRepositoryEloquent extends BaseRepository implements TutorialTestRepository
{
    use RepositoriesTrait;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TutorialTest::class;
    }

    public function myPaginate($input)
    {
        isset($input['per_page']) ?: $input['per_page'] = 10;
        return $this->makeModel()
            ->filter($input)
            ->paginate($input['per_page']);

    }

    public function store($input)
    {
        $input['created_by'] = auth()->id();
        $input = $this->standardized($input, $this->makeModel());
        $this->create($input);
    }

    public function change($input, $data)
    {
        $input = $this->standardized($input, $data);
        $this->update($input, $data->id);
    }


    private function standardized($input, $data)
    {
        $input['updated_by'] = auth()->id();
        $input = $data->uploads($input);
        return $data->checkbox($input);
    }

    public function destroy($data)
    {
        // TODO: Implement remove() method.
    }

    /**
     * Boot up the repository, ping criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
