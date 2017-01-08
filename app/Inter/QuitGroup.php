<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/7
 * Time: 23:20
 */
namespace App\Inter;
use App\dao\Dao;
use App\Helper\TencentHelper;
use Illuminate\Support\Facades\Validator;


class QuitGroup extends \App\Inter\AbstractInterface
{

    public function _verifyInput()
    {
        // TODO: Implement _verifyInput() method.
        $validator = Validator::make(rq(),
            [
                'liver_id' => 'required|integer',
                'user_id' => 'required|integer',
                'group_id' => 'required|integer'
            ],[
                'liver_id.required' => 'liverID不存在',
                'group_id.required' => 'userID不存在',
                'user_id.required' => 'groupID不存在'
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
        $dao = new Dao();
        $ret=$dao->RemoveGroupInfo(rq('user_id'),rq('liver_id'),rq('group_id'));
        if($ret['status'] !=0 )
            return err();
        return suc();

    }
}