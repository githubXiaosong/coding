<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/5
 * Time: 18:08
 */
namespace  App\Inter;
use Illuminate\Support\Facades\Validator;
class ChangStatus extends \App\Inter\AbstractInterface
{

    public function _verifyInput()
    {
        // TODO: Implement _verifyInput() method.
        $validator = Validator::make(rq(),
            [
                'liver_id' => 'required|exists:livers,id|integer',
                'status' => 'required|integer'
            ],
            [
                'user_id.exists'=>'没有该频道'
            ]);

        if( $validator->fails()) {
            $this->errorMeg= $validator->messages();
            return false;
        }

        return true;
    }

    /**
     * 请求处理
     * 业务逻辑判断
     * 给客户端返回json
     */

    public function _process()
    {
        // TODO: Implement _process() method.
        $ret=(new \App\dao\Dao())->ModifyLiveStatus(rq('liver_id'),rq('status'));
        if( $ret['status'] != 0)
        {
            return err('db error');
        }
        return suc();


    }
}