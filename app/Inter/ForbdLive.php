<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/7
 * Time: 21:14
 */

namespace App\Inter;
use App\dao\Dao;
use App\Helper\TencentHelper;
use Illuminate\Support\Facades\Validator;


class ForbidLive extends AbstractInterface
{

    public function _verifyInput()
    {

        // TODO: Implement _verifyInput() method.
        $validator = Validator::make(rq(),
            [
                'liver_id' => 'required|integer',
                'flag' => 'required|integer|min:0||in:0,1'
            ],[
                'liver_id.required' => '禁播ID不存在'
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

        /**
         * 先进行查询如果数据库中的状态和发送过来的状态是相同的 就直接返回
         *
         * 如果数据库中的状态和禁播状态是不同的 就调用通讯云的接口设置状态同时更新数据
         */

        $dao = new Dao();
        $ret=$dao->IsSameLiverForbidStatus(rq('liver_id'),rq('flag'));
        if($ret['status'] != 0)
            return $ret;

        if($ret['is_same'] == 0)
            return suc();

        $ret_ten=TencentHelper::Live_Channel_SetStatus(rq('liver_id'),rq('flag'));
        if(!$ret_ten)
        {
            err(['msg' => $ret_ten['message'] ,'errmsg' => $ret_ten['errmsg'] ]);
        }

        if($dao->ChangeForbidStatusLiver(rq('live_id'),rq('flag')) != 0)
            return err('db error');
        return suc();

    }
}