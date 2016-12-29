<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/27
 * Time: 9:21
 */
namespace App\Callback;


 use Illuminate\Support\Facades\Request;

 class Callback{

     public function tencentCallback()
     {

//         dd(Request::getContent());

         /**
         t	string	有效时间	UNIX时间戳(十进制)
         sign	string	安全签名	MD5(KEY+t)
         event_type	int	事件类型	目前可能值为： 0、1、100、200
         stream_id	string	直播码	标示事件源于哪一条直播流
         channel_id	string	直播码	同stream_id
          *
          * 在收到消息通知的http请求里返回错误码 0 以代表您已经成功收到了消息，从而避免腾讯云反复重复通知
          * { "code":0 }
          *
          *
          * 目前腾讯云支持三种消息类型的通知：0 — 断流； 1 — 推流；100 — 新的录制文件已生成；200 — 新的截图文件已生成。
          */




         $data=json_decode(Request::getContent(),true);


         if(!(isset($data['t']) && isset($data['sign']) &&
             isset($data['event_type']) && isset($data['stream_id'])))
             return ['code'=>1];


         if((time()-$data['t'])>600)
             return ['code'=>2];

         if(md5(defineKey.$data['t'])!=$data['sign'])
             return ['code'=>3];

        switch( $data['event_type'] )
        {
            case 0:

                break;

            case 1:
                break;

            case 100:
                break;

            case 200:
                break;

            default:
                break;
        }

         return ['code'=>0];




     }

}