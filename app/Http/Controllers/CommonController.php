<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Helper\GlobalFunction;
=======

use App\Helper\GlobalFunction;
use App\Helper\ValidateCode;
>>>>>>> origin/master
use App\Http\Requests;

use App\Pet;
use App\PetStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Live;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\DB;
>>>>>>> origin/master

class CommonController extends Controller
{

<<<<<<< HEAD
    /**
     * 返回session中的用户有没有直播信息
     */
    public function haveLive()
    {
        $status = Live::where(['user_id' => session()->get('user')->id])->first();
        return GlobalFunction::returnModel(0, 'OK', $status ? 1 : 0);
    }
=======
>>>>>>> origin/master

    /**
     * 测试 API
     *
     */

    public function test()
    {
<<<<<<< HEAD
        //查出所有的ID集合
        $ids=DB::table('pets')->get(['id']);

        $data = [];

        foreach($ids as $id)
        {
            $petstatus = DB::table('pet_status')->where(['pet_id'=>$id->id])->orderBy('created_at')->get();
            $data[$id->id] = $petstatus;
        }


=======
        echo base_path("asd");
>>>>>>> origin/master

    }

}


