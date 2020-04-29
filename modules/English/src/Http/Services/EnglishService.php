<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 5/17/19
 * Time: 10:39 PM
 */

namespace English\Http\Services;

use English\Models\Crazy;
use English\Models\FillInTheBlank;
use English\Models\Mistake;
use English\Models\Pronunciation;
use English\Models\Similarity;
use Landing\Models\Slide;

class EnglishService
{
    public function overview() {
        $crazyList = Crazy::pluck('name', 'id');

        if (auth()->check()) {
            $user_id = auth()->id();
            $filter = [
                'user_id' => $user_id,
                'type' => 0
            ];
            foreach ($crazyList as $id => $name) {
                $filter['crazy_id'] = $id;
            }
        }

        $pronunciationPage = ceil(app(Pronunciation::class)->count() / ENGLISH_PER_PAGE);
        $mistakesPage = ceil(app(Mistake::class)->count() / ENGLISH_PER_PAGE);
        $fillInTheBlankPage = ceil(app(FillInTheBlank::class)->count() / ENGLISH_PER_PAGE);
        $similarityPage = ceil(app(Similarity::class)->count() / ENGLISH_PER_PAGE);
        $slides = app(Slide::class)->where('is_active', 1)->orderBy('no')->get();

        return compact(
            'pronunciationPage',
            'mistakesPage',
            'fillInTheBlankPage',
            'similarityPage',
            'crazyList',
            'slides'
        );
    }
}
