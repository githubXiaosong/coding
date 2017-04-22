<?php

namespace App\Http\Controllers;

use App\Helper\GlobalFunction;
use App\Http\Requests;

use App\Pet;
use App\PetStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Live;
use App\User;
use Illuminate\Routing\Controller;

class CommonController extends Controller
{

    /**
     * 返回session中的用户有没有直播信息
     */
    public function haveLive()
    {
        $status = Live::where(['user_id' => session()->get('user')->id])->first();
        return GlobalFunction::returnModel(0, 'OK', $status ? 1 : 0);
    }

    /**
     * 测试 API
     *
     */

    public function test()
    {
        //查出所有的ID集合
        $ids=DB::table('pets')->get(['id']);

        $data = [];

        foreach($ids as $id)
        {
            $petstatus = DB::table('pet_status')->where(['pet_id'=>$id->id])->orderBy('created_at')->get();
            $data[$id->id] = $petstatus;
        }



    }

}


