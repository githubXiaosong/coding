<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/5
 * Time: 22:01
 */
namespace App\Inter;
use App\dao\Dao;
use Illuminate\Support\Facades\Validator;


/**
 * Class FetchGroupMemberList
 * @package App\Inter
 * group_id 为空的话就是返回所有的关于liver_id的数据
 */
class FetchGroupMemberList extends AbstractInterface
{

    public function _verifyInput()
    {
        // TODO: Implement _verifyInput() method.

        $validator = Validator::make(rq(),
            [
                'liver_id' => 'required|exists:livers,id|integer',
                'group_id' => 'integer',
                'page_num' => 'required|integer|min:0',
                'page_size' => 'required|integer|min:5'
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
        $result=(new Dao())->GetGroupList(rq('liver_id'),rq('group_id'),rq('page_num'),rq('page_size'));
        if($result['status'] != 0)
        {
            return err('db error');
        }
        return suc( $result['data']['groups'] ) ;
    }



}