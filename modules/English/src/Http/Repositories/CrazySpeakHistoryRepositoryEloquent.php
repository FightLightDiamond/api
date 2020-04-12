<?php

namespace English\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use English\Models\CrazySpeakHistory;

/**
 * ClassCrazySpeakHistoryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CrazySpeakHistoryRepositoryEloquent extends BaseRepository implements CrazySpeakHistoryRepository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CrazySpeakHistory::class;
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
        $input = $this->standardized($input, $this->makeModel());
        return $this->create($input);
    }

    public function edit($id)
    {
        $crazySpeakHistory = $this->find($id);

        if (empty($crazySpeakHistory)) {
            return $crazySpeakHistory;
        }

        return compact('crazySpeakHistory');
    }

    public function change($input, $data)
    {
        $input = $this->standardized($input, $this->makeModel());
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
