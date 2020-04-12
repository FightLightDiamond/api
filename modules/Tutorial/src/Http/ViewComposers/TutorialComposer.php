<?php
/**
 * Created by PhpStorm.
 * User: JK
 * Date: 3/31/2018
 * Time: 2:09 PM
 */

namespace Tutorial\Http\ViewComposers;


use Illuminate\View\View;
use Tutorial\Models\Tutorial;

class TutorialComposer
{
    public function compose(View $view)
    {
        $list =  app(Tutorial::class)->pluck('name', 'id')->toArray();
        $view->with('tutorialCompose', $list);
    }
}
