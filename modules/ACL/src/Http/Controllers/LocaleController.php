<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 11/6/18
 * Time: 09:46
 */

namespace ACL\Http\Controllers;


use App\Http\Controllers\Controller;

class LocaleController extends Controller
{
    public function session($locale)
    {
        session(['user.locale' => $locale]);
        return back();
    }

    public function db()
    {
        $user = auth()->user();

        $user->locale = request('locale');
        $user->save();

        return back();
    }
}