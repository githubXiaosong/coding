<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/5
 * Time: 21:34
*/
namespace App\Inter;
use App\dao\Dao;
use Illuminate\Support\Facades\Validator;
class EnterGroup extends AbstractInterface
{

    public function _verifyInput()
    {
        // TODO: Implement _verifyInput() method.
        // TODO: Implement _verifyInput() method.
        $validator = Validator::make(rq(),
            [
                'liver_id' => 'required|exists:livers,id|integer',
                'user_id' => 'required|integer',
                'group_id' => 'required|integer',
                'nickname' => 'string',
                'head_pic' => 'acrive_url'
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
        $dao = new Dao();
        $ret=$dao->AddGroupInfo(rq('user_id'),rq('liver_id'),rq('group_id'),rq('nick_name'),rq('head_pic'));
        if($ret['status'] != 0)
        {
            return err('db error');
        }
        $ret = $dao->ChangeLiveCount(rq('liver_id'),0,0);
        if($ret['status'] != 0)
        {
            return err('db error');
        }
        return suc();
    }
}

