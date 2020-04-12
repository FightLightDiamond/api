<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 5/26/19
 * Time: 11:17 AM
 */

namespace ACL\Utils;


class Locale
{
    public function getCountryClient()
    {
        $ip = request()->ip();

        return geoip($ip)->country;
    }

    public function getCountryByIp($ip)
    {
        return geoip($ip)->country;
    }

    public function getIpServer()
    {
        return file_get_contents(config('api.ipfy'));
    }
}