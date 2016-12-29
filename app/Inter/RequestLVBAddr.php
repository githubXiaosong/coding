<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/28
 * Time: 18:43
 */
namespace App\Inter;

use App\Helper\TencentHelper;
use Illuminate\Support\Facades\Validator;

/**
 * Class RequestLVBAddr
 * @package App\Inter 创建一个直播流
 *
 *
 * 0 新房间
 * 1 直播中
 * 2 已关闭(暂时未启用)
 */
class RequestLVBAddr extends AbstractInterface
{

    /**
     *
     * 输入校验
     * @param array $args 输入参数
     */



    public function _verifyInput()
    {
        $validator = Validator::make(rq(),
            [
                'title' => 'required|max:255|min:0',
                'desc' => 'required',
                'category_id' => 'required|min:0|integer'
            ],
            [
                'title.required'=>'必须输入描述哦',
                'title.max'=>'描述信息太短啦',
                'title.min'=>'描述信息太长啦'
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
        /**
         * 是否登录
         */
        $user_=userins();
        $userid=$user_->is_login();
        if(!$userid)
            return err('please login first');


        /**
         *查出用户鉴权
         */
        $user=$user_->find($userid);
        if(!$user)
            return err('no that user');

        /**
         * status 0观众 1主播(未直播)
         * 只有1才能推流 其他都不可以
         */

        if($user->status != '1')
            return err('define err');

        $expiredTime=date('Y-m-d H:i:s',strtotime('+1 minute'));

        $url=TencentHelper::getPushUrl(bizId,$userid,defineKey,$expiredTime);

        /**
         *    是否请求过 表中已经有了
         */
        $room=roomins();
        if($room->where(['user_id'=>$userid])->first())
            return err('exists!');

        /**
         * 存储数据到db
         */
        $room->user_id=$userid;
        $room->url=$url;
        $room->title=rq('title');
        $room->desc=rq('desc');
        $room->category_id=rq('category_id');

        if(!$room->save())
            return err('db error');


        return ['status'=>0,'data'=>[
            'url'=>$url
        ]];
    }
}