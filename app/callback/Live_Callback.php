<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/27
 * Time: 9:21
 */


namespace App\callback;


use App\dao\Dao;
use App\Helper\GlobalFunction;

class Live_Callback
{


    const EC_SYSTEM_SUCCEED = 0;
    const EC_SYSTEM_INVALID_PARAM = 1;
    const EC_SYSTEM_INVALID_SIGN = 2;
    private $data;
    private $event_type;
    private $stream_id;

    protected function init()
    {

        $request = file_get_contents("php://input");
        $this->data = json_decode($request, true);

        if (!$this->data) {
            return self::EC_SYSTEM_INVALID_PARAM;
        }

        if (array_key_exists("t", $this->data)
            && array_key_exists("sign", $this->data)
            && array_key_exists("event_type", $this->data)
            && array_key_exists("stream_id", $this->data)
        ) {
            $this->event_type = $this->data['event_type'];
            $this->stream_id = $this->data['stream_id'];
            $check_t = $this->data['t'];
            $check_sign = $this->data['sign'];

            /**
             * 这个if没有测试
             */
            if ($check_sign != GlobalFunction::GetCallBackSign($check_t)) {
                return self::EC_SYSTEM_INVALID_SIGN;
            }

            return self::EC_SYSTEM_SUCCEED;
        } else {
            return self::EC_SYSTEM_INVALID_PARAM;
        }
    }

    public function process()
    {
        $ret = $this->init();
        if ($ret == 0) {
            $dao = new Dao();
            if ($this->event_type == 0) {
                $ret = $dao->CallBackLiveStatus($this->stream_id, 0) ['status'];
            } elseif ($this->event_type == 1) {
                $ret = $dao->CallBackLiveStatus($this->stream_id, 1) ['status'];
            } else {
                dd('event type is 100/200/error ');
            }
        }

        $json_result = json_encode(array(
            'code' => $ret
        ));
        header("Content-Length:" . strlen($json_result));
        echo $json_result;
    }

}