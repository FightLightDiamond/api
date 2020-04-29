<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 5/17/19
 * Time: 11:36 PM
 */

namespace English\Http\Builders;


class ReadMathCrazyBuilder extends TestBuilder
{
    public function getThreads($id)
    {
        $this->crazy = $crazy = $this->repository->find($id);

        $ens = $this->getListRand('sentence');
        $vis = $this->getListRand('meaning');
        return compact('ens', 'vis', 'crazy');
    }

    public function done($id, $sentences, $meanings)
    {
        $this->crazy = $this->repository->find($id);

        $this->getDetail()
            ->checkTest($sentences, $meanings)
            ->saveHistory($this->historyRepository)
            ->statistic($this->historyRepository);

        return $this->data;
    }

    private function checkTest($sentences, $meanings)
    {
        $result = [];

        foreach ($this->details as $i => $crazyDetail) {
            $result[$i] = [
                'id' => $crazyDetail['id'],
                'is_correct' => false
            ];

            if ($sentences[$i]['id'] == $crazyDetail['id'] && $meanings[$i]['id'] === $crazyDetail['id']) {
                $this->score++;

                $result[$i] = [
                    'id' => $crazyDetail['id'],
                    'is_correct' => true
                ];
            }
        }

        $this->data['score'] = $this->score;
        $this->data['result'] = $result;
        $this->data['user'] = auth('api')->id();

        return $this;
    }
}
