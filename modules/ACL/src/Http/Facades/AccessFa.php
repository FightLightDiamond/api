<?php
/**
 * Created by PhpStorm.
 * User: np
 * Date: 10/25/17
 * Time: 3:27 PM
 */

namespace ACL\Http\Facades;

use Illuminate\Support\Facades\Facade;

class AccessFa extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'AccessFa';
    }
}
