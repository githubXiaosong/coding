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
        return md5(API_DEFINE_KEY . strval($time));
    }

//    return ['status' => 1, 'msg' => ['code' => [0 => '验证码有误']]];
    static function returnModel($status, $msg = null,$data = null)
    {
        return ['status' => $status, 'msg' => $msg ,'data' => $data];
    }

    static function getCurlOutput($addr)
    {
        $ch = curl_init($addr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output);
    }


}

