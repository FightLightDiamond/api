<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 9/26/18
 * Time: 2:32 PM
 */

namespace English\Http\ViewComposers;

use English\Models\CrazyCourse;
use Illuminate\View\View;

class CrazyCourseComposer
{
    public function compose(View $view)
    {
        $crazyCourseCompose = CrazyCourse::pluck('name', 'id');
        return $view->with(compact('crazyCourseCompose'));
    }
}
