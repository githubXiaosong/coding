<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/29
 * Time: 16:15
 */
namespace App\Inter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Class ChangeStatus
 * @package App\Inter
 *
    2.修改在线状态
主播开始推流，并收到开始推流事件（PUSH_EVT_PUSH_BEGIN）时，调用此接口
，将该流状态置为上线；主播停止推流后，调用此接口，将该流状态置为下线
 *
 *
userid	string	用户id
status	int	0:上线 1:下线
 */
class ChangeStatus extends \App\Inter\AbstractInterface
{

    /**
     *
     * 输入校验
     * @param array $args 只负责输入参数的类型校验  不负责逻辑校验
     */

    public function _verifyInput()
    {
        // TODO: Implement _verifyInput() method.
        $validator = Validator::make(rq(),
            [
                'user_id' => 'required|exists:rooms,user_id',
                'status' => 'required|min:0',
            ],
            [
                'user_id.exists'=>'没有该频道'
            ]);

        if( $validator->fails() ) {
            $this->errorMeg= $validator->messages();
            return false;
        }

        return true;
    }

    /**
     *
     * 请求处理
     */
    public function _process()
    {
        // TODO: Implement process() method.


        $room=roomins()->where(['user_id'=>rq('user_id')])->first();
        switch (rq('status')) {
            case 0:
                /**
                 * 只能是新房间才能开始推流
                 */
                if($room->status!=0)
                    return err('define time');
                $ret=roomins()->where(['user_id'=>rq('user_id')])->update(['status'=>1]);
                break;
            case 1:
                /**
                 * 只能正在直播才能下线
                 */
                if($room->status!=1)
                    return err('define time');
                $ret=$room->delete();
                break;
            default:
                return err('error status');
        }

        if(!$ret)
            return err('db error');
        return suc();

                /**
                 * 修改数据库
                 */

                /**
                 * 返回数据
                 */
    }
}