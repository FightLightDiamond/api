<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 5/17/19
 * Time: 11:22 PM
 */

namespace English\Http\Builders;


use English\Http\Repositories\CrazyHistoryRepository;
use English\Http\Repositories\CrazyRepository;
use English\Http\Repositories\CrazyWriteHistoryRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestBuilder
{
    public $repository, $historyRepository, $crazyWriteHistoryRepository;
    public $data, $details, $sentenceList, $score = 0;
    public $crazy = NULL;

    public function __construct(
        CrazyRepository $repository,
        CrazyHistoryRepository $historyRepository,
        CrazyWriteHistoryRepository $crazyWriteHistoryRepository
    )
    {
        $this->repository = $repository;
        $this->historyRepository = $historyRepository;
        $this->crazyWriteHistoryRepository = $crazyWriteHistoryRepository;
    }

    public function getDetail()
    {
        $this->details = $this->crazy->details()
            ->orderBy('no')
            ->get(['meaning', 'id', 'sentence']);
        return $this;
    }

    public function statistic($repo)
    {
        if (auth('api')->check()) {
            $filter = [
                'user_id' => auth('api')->id(),
                'crazy_id' => $this->crazy->id,
            ];

            $this->data['testedCount'] = $repo->filterCount($filter);

            foreach ([0 => 'avgFirst', 1 => 'avgAgain'] as $type => $value) {
                $filter['type'] = $type;
                $this->data[$value] = round($repo->filterAvg($filter, 'score') / 100, 2);
            }
        }

        return $this;
    }

    public function getCrazyCourse()
    {
        $this->data['crazyCourse'] = $this->crazy->crazyCourse;
        return $this;
    }

    public function saveHistory($repo)
    {
        if (auth('api')->check()) {
            $mark = $this->score === 0 ? 0 : (int)($this->score / count($this->details) * 1000);

            $historyData = [
                'user_id' => auth('api')->id(),
                'crazy_id' => $this->crazy->id,
                'score' => $mark,
                'type' => request('type', 0),
            ];

            $repo->create($historyData);
        }

        return $this;
    }

    public function getCrazyList()
    {
        $this->data['crazyList'] = $this->repository
            ->filterList(['crazy_course_id' => $this->crazy['crazy_course_id']]);

        return $this;
    }

    public function getListRand($field)
    {
        return $this->crazy->details()
            ->orderBy(DB::raw('RAND()'))
            ->select($field, 'id')->get();
    }

    public function courseList()
    {
        $this->data['crazyList'] = $this->repository
            ->filterList(['crazy_course_id' => $this->crazy['crazy_course_id']]);

        return $this;
    }

    public function getSentenceList()
    {
        $this->sentenceList = $this->details
            ->pluck('sentence', 'id');

        return $this;
    }
}
