<?php

namespace App\Http\Controllers\Service;

use App\Helper\TencentHelper;
use App\Live;
use Illuminate\Routing\Controller;
use App\Http\Requests;
use App\Helper\GlobalFunction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LiveController extends Controller
{

    const DB_ERROR = 3;

    public function changeTitle()
    {
        $validator = Validator::make(
            rq(),
            [
                'live_id' => 'required|exists:lives,id',
                'title' => 'required|max:32'
            ],
            [
            ]
        );
        if ($validator->fails())
            return GlobalFunction::returnModel(1, $validator->messages());
        $ret = DB::table('lives')
            ->where('id', rq('live_id'))
            ->update(['title' => rq('title')]);
        if ($ret == 0)
            return GlobalFunction::returnModel(self::DB_ERROR);
        return GlobalFunction::returnModel(0);
    }

    public function createLive()
    {
        $validator = Validator::make(
            rq(),
            [
                'title' => 'required|max:32',
                'desc' => 'max:255',
                'category'=>'required|exists:categories,id',
                'accept' => 'accepted'
            ],
            [
            ]
        );
        if ($validator->fails())
            return GlobalFunction::returnModel(1, $validator->messages());

        $user_id = session()->get('user')->id;

        if(Live::where('user_id',$user_id)->first())
            return  GlobalFunction::returnModel(3,'the user living!');

        $pushaddr = TencentHelper::GetPushUrl(BIZID, $user_id, PUSH_SECRET_KEY, '+10 hours');

        $live = new Live();
        $live->title = rq('title');
        $live->pushaddr = $pushaddr;
        $live->desc = rq('desc');
        $live->user_id = $user_id;
        $live->category_id = rq('category');

        if ($live->save())
            return GlobalFunction::returnModel(0);
        return GlobalFunction::returnModel(self::DB_ERROR);
    }


    //废弃
    public function enterGroup()
    {
        $validator = Validator::make(
            rq(),
            [
                'live_id' => 'exists:lives,id|required',
            ],
            [
            ]
        );
        if ($validator->fails())
            return GlobalFunction::returnModel(1, $validator->messages());


        DB::table('lives')->increment('watchnum');
        return GlobalFunction::returnModel(0);
    }

    //废弃
    public function quitGroup()
    {
        $validator = Validator::make(
            rq(),
            [
                'live_id' => 'exists:lives,id|required',
            ],
            [
            ]
        );
        if ($validator->fails())
            return GlobalFunction::returnModel(1, $validator->messages());


        DB::table('lives')->decrement('watchnum');
        return GlobalFunction::returnModel(0);
    }

}
