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


//                        $ret = DB::table('lives')
//                            ->where(['user_id' => (substr($data['stream_id'], 5))])
//                            ->update([
//                                'frontcover' => 'http://' . COS_BUCKET_NAME . '-' . APPID . '.file.myqcloud.com' . $data['pic_url']
//                            ]);
//                        if ($ret == 0)

//                            exit("ERROR200");
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

