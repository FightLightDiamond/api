<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 9/25/18
 * Time: 3:31 PM
 */

namespace English\Http\ViewComposers;


use English\Models\Crazy;
use Illuminate\View\View;

class CrazyNoCourseComposer
{
    public function compose(View $view)
    {
        $crazyNoCourseCompose = Crazy::whereNull('crazy_course_id')
            ->pluck('name', 'id');
        return $view->with(compact('crazyNoCourseCompose'));
    }
}
