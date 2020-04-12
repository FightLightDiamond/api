<?php

namespace English\Http\Repositories;


use English\Models\Crazy;
use English\Models\CrazyCourse;
use English\Models\CrazyReadHistory;
use English\Models\CrazyWriteHistory;
use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class NewsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CrazyCourseRepositoryEloquent extends BaseRepository implements CrazyCourseRepository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CrazyCourse::class;
    }

    public function myPaginate($input)
    {
        isset($input[PER_PAGE]) ?: $input[PER_PAGE] = 10;
        return $this->makeModel()
            ->filter($input)
            ->orderBy('id', 'DESC')
            ->paginate($input[PER_PAGE]);
    }

    public function store($input)
    {
        logger(__METHOD__);
//        logger($input);
        $input = $this->standardized($input, $this->makeModel());
//        logger($input);
        $crazyCourse = $this->create($input);
//        $this->updateCourse($input['crazy_ids'], $crazyCourse->id);
        return $crazyCourse;
    }

    private function updateCourse($crazyIds, $crazyCourseId)
    {
        Crazy::where('crazy_course_id', $crazyCourseId)
            ->update(['crazy_course_id' => NULL]);

        Crazy::whereIn('id', $crazyIds)
            ->update(['crazy_course_id' => $crazyCourseId]);
    }

    public function edit($id)
    {
        $crazyCourse = $this->find($id);

        if (empty($crazyCourse)) {
            return $crazyCourse;
        }

        $crazyList = $crazyCourse->crazies()->pluck('name', 'id');
        return compact('crazyCourse', 'crazyList');
    }

    public function show($id)
    {
        $crazyCourse = $this->find($id);

        if (empty($crazyCourse)) {
            return NULL;
        }

        $crazyList = $crazyCourse->crazies()->pluck('name', 'id');

        $testCounts = [];
        $avgScores = [];

        if (auth()->check()) {
            $user_id = auth()->id();
            $filter = [
                'user_id' => $user_id,
                'type' => 0
            ];
            foreach ($crazyList as $id => $name) {
                $filter['crazy_id'] = $id;
                $testCounts[$id] = CrazyReadHistory::filter($filter)->count();
                $avgScores[$id] = round(CrazyReadHistory::filter($filter)->avg('score') / 100, 2);
                $testWriteCounts[$id] = CrazyWriteHistory::filter($filter)->count();
                $avgWriteScores[$id] = round(CrazyWriteHistory::filter($filter)->avg('score') / 100, 2);
            }
        } else {
            foreach ($crazyList as $id => $name) {
                $testCounts[$id] = 0;
                $avgScores[$id] = 0;
                $testWriteCounts[$id] = 0;
                $avgWriteScores[$id] = 0;
            }
        }
        return compact('crazyCourse', 'crazyList', 'testCounts', 'avgScores', 'testWriteCounts', 'avgWriteScores');
    }

    public function change($input, $data)
    {
        $input = $this->standardized($input, $data);
//        $this->updateCourse($input['crazy_ids'], $data->id);
        return $this->update($input, $data->id);
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
