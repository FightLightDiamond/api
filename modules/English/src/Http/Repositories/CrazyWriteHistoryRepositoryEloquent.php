<?php

namespace English\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use English\Models\CrazyWriteHistory;

/**
 * ClassCrazyWriteHistoryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CrazyWriteHistoryRepositoryEloquent extends BaseRepository implements CrazyWriteHistoryRepository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CrazyWriteHistory::class;
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
        $crazyWriteHistory = $this->find($id);

        if (empty($crazyWriteHistory)) {
            return $crazyWriteHistory;
        }

        return compact('crazyWriteHistory');
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
