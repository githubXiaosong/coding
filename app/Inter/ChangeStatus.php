<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/5
 * Time: 16:23
 */
namespace  App\Inter;
use Illuminate\Support\Facades\Validator;
class ChangeStatus extends \App\Inter\AbstractInterface
{

    public function _verifyInput()
    {
        // TODO: Implement _verifyInput() method.
        $validator = Validator::make(rq(),
            [
                'liver_id' => 'required|exists:livers,id',
                'type' => 'required|integer',
                'optid' => 'required|integer'
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
     * 业务逻辑判断
     * 请求处理
     */
    public function _process()
    {
        // TODO: Implement _process() method.
        $ret=(new \App\dao\Dao())->ChangeLiveCount(rq('liver_id'),rq('type'),rq('optid'));
        if( $ret['status'] != 0)
        {
            return err('db error');
        }
        return suc();
    }


}