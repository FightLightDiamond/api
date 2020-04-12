<?php
/**
 * Created by PhpStorm.
 * User: CPM
 * Date: 8/5/2018
 * Time: 10:58 AM
 */

namespace English\Http\ViewComposers;


use English\Models\Crazy;
use Illuminate\View\View;

class CrazyComposer
{
    public function compose(View $view)
    {
        $crazyCompose = Crazy::pluck('name', 'id');
        return $view->with(compact('crazyCompose'));
    }
}
