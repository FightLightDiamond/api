<?php

namespace GCard\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use GCard\Models\Hero;

/**
 * ClassHeroRepositoryEloquent
 * @package namespace App\Repositories;
 */
class HeroRepositoryEloquent extends BaseRepository implements HeroRepository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Hero::class;
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
        return $this->create($input);
    }

    public function edit($id)
    {
        $hero = $this->find($id);

        if (empty($hero)) {
            return $hero;
        }

        return compact('hero');
    }

    public function change($input, $data)
    {
        return $this->update($input, $data->id);
    }

    public function import($file)
    {
        set_time_limit(9999);
        $path = $this->makeModel()->uploadImport($file);

        return $this->importing($path);
    }

    private function standardized($input, $data)
    {
        return $data->uploads($input);
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
