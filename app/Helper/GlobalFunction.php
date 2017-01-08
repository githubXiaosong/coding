<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/4
 * Time: 19:07
 */
namespace App\Helper;
class GlobalFunction
{

    static function GetCallBackSign($time)
    {
        return md5(DEFINE_KEY . strval($time));
    }
}