<?php
/**
 * Created by PhpStorm.
 * User: CPM
 * Date: 6/18/2018
 * Time: 12:02 AM
 */

namespace English\Http\Repositories;


class EnglishRepositoryTrait
{
    protected $score;
    public function mark($rep, $answer)
    {
        if ($rep === $answer) {
            $this->score += 1;
            return true;
        }
        return false;
    }
}