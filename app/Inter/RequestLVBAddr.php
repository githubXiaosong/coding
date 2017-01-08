<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/7
 * Time: 23:32
 */
namespace App\Inter;
use App\dao\Dao;
use App\Helper\TencentHelper;
use Illuminate\Support\Facades\Validator;


/**
 * Class RequestLVBAddr
 * @package App\Inter
 */

//todo
class RequestLVBAddr extends \App\Inter\AbstractInterface
{

    public function _verifyInput()
    {
        // TODO: Implement _verifyInput() method.
        $validator = Validator::make(rq(),
            [
                'group_id' => 'required|integer',
                'title' => 'required|min:4|max:30',
                'head_pic' => 'image',
                'front_cover' => ''
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
        /**
         * 1TencentHelper创建一个推流地址和三个播放地址
         * 2在图床中存储头像信息和头页信息
         * 3在数据库中添加一条记录
         */
        //todo




    }
}