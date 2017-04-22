<?php

namespace App\Http\Controllers\Server;

use App\Helper\GlobalFunction;
use App\Http\Requests;
use App\Tape;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CallBackController extends Controller
{
    public function liveCallBack()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if ($data) {
            if ($data['sign'] == GlobalFunction::GetCallBackSign($data['t'])) {
                switch ($data['event_type']) {
                    case TENCENT_STREAM_OFF:

                        $ret = DB::table('lives')
                            ->where(['user_id' => (substr($data['stream_id'], 5))])
                            ->update(['status' => 0]);
                        if ($ret == 0)
                            exit("ERROR1");

                        break;

                    case TENCENT_STREAM_ON:

                        $ret = DB::table('lives')
                            ->where(['user_id' => (substr($data['stream_id'], 5))])
                            ->update(['status' => 1]);
                        if ($ret == 0)
                            exit("ERROR1");
                        break;

                    case TENCENT_NEW_TAPE:
                        $tape = new Tape();

                        break;

                    case TENCENT_NEW_PIC:
			 $ret = DB::table('lives')
                            ->where(['user_id' => (substr($data['stream_id'], 5))])
                            ->update(['frontcover' => $data['pic_full_url']]);
                        if ($ret == 0)
                            Log::error('update img error');	
                        break;

                    default:
                        break;
                }
                $json_result = json_encode(['code' => 0]);
                header("Content-Length:" . strlen($json_result));
                echo $json_result;
                exit(0);
            }
        }
        exit("ERROR");
    }




}


//    {
//    "app": "1234.livepush.myqcloud.com",
//    "appname": "live",
//    "channel_id": "4465_1",
//    "event_type": 1,
//    "sign": "467264dff7256187e56aae2fdbaf27e8",
//    "stream_id": "4465_1",
//    "t": 1473126233
//    }

//    {
//    "channel_id": "1234_15919131751",
//    "end_time": 1473125627,
//    "event_type": 100,
//    "file_format": "flv",
//    "file_id": "9192487266581821586",
//    "file_size": 9749353,
//    "sign": "fef79a097458ed80b5f5574cbc13e1fd",
//    "start_time": 1473135647,
//    "stream_id": "1234_15919131751",
//    "t": 1473126233,
//    "video_id": "200025724_ac92b781a22c4a3e937c9e61c2624af7",
//    "video_url": "http://200025724.vod.myqcloud.com/200025724_ac92b781a22c4a3e937c9e61c2624af7.f0.flv"
//    }
