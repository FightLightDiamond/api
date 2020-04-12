<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 8/8/18
 * Time: 8:36 PM
 */

namespace English\Http\Services;


use English\Http\Builders\ReadMathCrazyBuilder;
use English\Http\Builders\WriteMathCrazyBuilder;
use English\Http\Repositories\CrazySpeakHistoryRepository;
use English\Models\CrazyListenHistory;
use English\Models\CrazySpeakHistory;

class CrazyTestService
{
    private $readMathCrazyBuilder;
    private $writeMathCrazyBuilder;
    private $speakHistoryRepository;

    public function __construct(ReadMathCrazyBuilder $readMathCrazyBuilder,
                                WriteMathCrazyBuilder $writeMathCrazyBuilder, CrazySpeakHistoryRepository $speakHistoryRepository)
    {
        $this->readMathCrazyBuilder = $readMathCrazyBuilder;
        $this->writeMathCrazyBuilder = $writeMathCrazyBuilder;
        $this->speakHistoryRepository = $speakHistoryRepository;

    }

    public function reading($id)
    {
        return $this->readMathCrazyBuilder->getThreads($id);
    }

    public function read($id, $sentences, $meanings)
    {
        return $this->readMathCrazyBuilder->done($id, $sentences, $meanings);
    }

    public function writing($id)
    {
        return $this->writeMathCrazyBuilder->getThreads($id);
    }

    public function written($id, $sentences)
    {
        return $this->writeMathCrazyBuilder->done($id, $sentences);
    }

    public function listening($id)
    {
        $user_id = auth('api')->id();
        $crazy_id = $id;

        $history = CrazyListenHistory::firstOrCreate(compact('user_id', 'crazy_id'));
        $history->increment('count', 1);
        return $history->save();
    }

    public function speak($id)
    {
        $input = request()->all();
        $input['user_id'] = auth('api')->id();
        $input['crazy_id'] = $id;

//        $history = $this->speakHistoryRepository->firstOrCreate(compact('user_id', 'crazy_id'));
        return $this->speakHistoryRepository->store($input);
    }
}
