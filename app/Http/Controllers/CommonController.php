<?php

namespace App\Http\Controllers;


use App\Helper\GlobalFunction;
use App\Helper\ValidateCode;
use App\Http\Requests;


use App\Live;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class CommonController extends Controller
{


    /**
     * 测试 API
     *
     */

    public function test()
    {
        echo base_path("asd");

    }

}


