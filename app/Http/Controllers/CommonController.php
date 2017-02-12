<?php

namespace App\Http\Controllers;


use App\Helper\ValidateCode;
use App\Http\Requests;


use App\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class CommonController extends Controller
{



    /**
     * 测试 API
     *
     */


    /**
     * 成功返回生成的验证码 失败var_dump
     */


    public function test()
    {
        dd(substr('4465_24',5));
    }

}


