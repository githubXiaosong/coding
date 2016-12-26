<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/26
 * Time: 16:34
 */
namespace App\Http\Controllers;

use App\Helper\TencentHelper;
use App\Http\Requests;
use APP\Helper;

class TencentController extends Controller
{


    /**
     *
     */
    public function createPush()
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
         * status 0观众 1主播(未直播) 2主播(直播中) 3封号 4被禁主播
         * 只有1才能推流 其他都不可以
         */

        if($user->status != '1')
            return err('define err');

        $expiredTime=date('Y-m-d H:i:s',strtotime('+1 minute'));

        return TencentHelper::getPushUrl(bizId,$userid,defineKey,$expiredTime);
    }



    public function getPlay()
    {


        if(!rq('stream_id'))
            return err('that no streamId');

        $user=userins()->find(rq('stream_id'));
        if(!$user)
            return err('that no user');
        if($user->status != '2') {
            if($user->status == '1')
                return err('that anchor is not online');
            if($user->status == '3')
                return err('that anchor had be forbid');
        }

        return TencentHelper::getPlayUrl(bizId,rq('stream_id'));
    }





}