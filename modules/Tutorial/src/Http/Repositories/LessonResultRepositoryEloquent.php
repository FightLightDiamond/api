<?php

namespace Tutorial\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;

use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Tutorial\Models\LessonResult;

/**
 * Class NewsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class LessonResultRepositoryEloquent extends BaseRepository implements LessonResultRepository
{
    use RepositoriesTrait;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LessonResult::class;
    }

    public function myPaginate($input)
    {
        isset($input['per_page']) ?: $input['per_page'] = 10;
        return $this->makeModel()
            ->with(['creator:id,email', 'lesson:id,title'])
            ->filter($input)
            ->paginate($input['per_page']);

    }

    public function store($input)
    {
        $input['create_by'] = auth()->check() ? auth()->id() : null;
        $this->create($input);
    }

    public function change($input, $data)
    {
        $this->update($input, $data->id);
    }

    private function standardized($input, $data)
    {
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
