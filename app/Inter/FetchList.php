<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/5
 * Time: 22:38
 */
namespace App\Inter;
use App\dao\Dao;
use Illuminate\Support\Facades\Validator;

class FetchList extends AbstractInterface
{

    public function _verifyInput()
    {
        // TODO: Implement _verifyInput() method.
        $validator = Validator::make(rq(),
            [
                'flag' => 'required|integer|min:0',
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

        $dao = new Dao();

        $ret=$dao->GetDataList(rq('type'),rq('page_num'),rq('page_size'));
        if($ret != 0)
        {
            return err('db error');
        }
        return suc($ret['data']['livers']);

    }
}
