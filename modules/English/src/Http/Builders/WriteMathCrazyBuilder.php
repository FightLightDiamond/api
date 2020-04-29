<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 5/17/19
 * Time: 11:39 PM
 */

namespace English\Http\Builders;

class WriteMathCrazyBuilder extends TestBuilder
{
    public function getThreads($id)
    {
        $this->crazy = $crazy = $this->repository->find($id);

        $lessons = $this->getLesson('sentence');
        $ens = $this->getListHash($lessons);
        $randEns = $this->getListRandEn($lessons);

        $this->data = compact('crazy', 'ens', 'vis', 'randEns');

        return $this->data;
    }

    public function done($id, $sentences)
    {
        $this->crazy = $this->repository->find($id);

        $this->getDetail()
            ->checkWritten($sentences)
            ->saveHistory($this->crazyWriteHistoryRepository)
            ->statistic($this->crazyWriteHistoryRepository);

        return $this->data;
    }


    private function getLesson($field)
    {
        return $this->crazy->details()
            ->orderBy('no')
            ->select($field, 'id')
            ->get()
            ->toArray();
    }

    private function getListHash($lessons)
    {
        foreach ($lessons as $id => $lesson) {
            $lessons[$id]['sentence'] = $this->hash($lesson['sentence']);
        }

        return $lessons;
    }

    private function getListRandEn($lessons)
    {
        foreach ($lessons as $id => $lesson) {
            $lessons[$id]['sentence'] = $this->rand($lesson['sentence']);
        }

        return $lessons;
    }

    private function hash($subject)
    {
        $pattern = '/[a-zA-Z]{1}/';
//        $pattern = '/[a-o]{1}/';
        return preg_replace($pattern, '*', $subject);
    }

    private function rand($subject)
    {
        $array = explode(' ', $subject);
        $array = $this->shuffle_assoc($array);

        return implode(' ', $array);
    }

    private function mix($subject)
    {
        $array = explode(' ', $subject);
        return $this->shuffle_assoc($array);
    }

    function shuffle_assoc($array)
    {
        $keys = array_keys($array);
        shuffle($keys);
        shuffle($keys);
        $new = [];

        foreach ($keys as $key) {
            $new[$key] = $array[$key];
        }

        return $new;
    }

    private function checkWritten($sentences)
    {
        logger($sentences);
        $result = [];

        foreach ($this->details as $i => $crazyDetail) {
            $crazyDetailId = $crazyDetail['id'];

            $result[$i] = [
                'id' => $crazyDetailId,
                'is_correct' => false
            ];

            $is_correct = $this->isWritePass(
                $sentences[$crazyDetailId],
                $crazyDetail['sentence']
            );

            if ($is_correct) {
                $this->score++;
                $result[$i] = [
                    'id' => $crazyDetailId,
                    'is_correct' => true
                ];
            }
        }

        $this->data['score'] = $this->score;
        $this->data['result'] = $result;

        return $this;
    }

    private function isWritePass($sentenceIn, $sentence)
    {
        $sentenceIn = $this->convert($sentenceIn);
        $sentence = $this->convert($sentence);

        return ($sentenceIn === $sentence);
    }

    private function convert($input)
    {
        return strtolower(trim(preg_replace('!\s+!', ' ', $input)));
    }
}
