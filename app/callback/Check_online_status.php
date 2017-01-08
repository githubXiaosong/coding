<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/4
 * Time: 17:28
 */

namespace App\callback;

use App\dao\Dao;
use App\Helper\TencentHelper;

class Check_online_status
{

    private $dao;

    private function check_call($stream_id)
    {
        echo $stream_id;
        $result = TencentHelper::Live_Channel_GetStatus($stream_id);
        //todo 又返回不了这个了 20601
        if ($result) {
            if ($result['ret'] == 20601) {
                dd('set status');
                $this->dao->UpdateCheckStatus($stream_id, 0);
                return true;
            }
            foreach ($result['output'] as $value) {
                if ($value['recv_type'] == 1) {
                    $this->dao->UpdateCheckStatus($stream_id, $value['status']);
                    break;
                }
            }
        } else {
            /**
             * 没有返回认为超时  本应该打印日志 但是 这里就不做了
             */
        }

    }

    public function check_status()
    {
        $this->dao = new Dao();
        $list = $this->dao->GetOnlineStreamId();

        if ($list['status'] == 0) {
            foreach ($list['data']['list'] as $key => $val) {
                $this->check_call($val['id']);
            }
        }
    }

}


/**
 * 在其他的地方调用完这个方法之后会继续的往下面执行下去
 */
$check_call = new Check_online_status(time());
$check_call->check_status();


?>