<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/7
 * Time: 23:04
 */

namespace App\Inter;
use App\dao\Dao;
use App\Helper\TencentHelper;
use Illuminate\Support\Facades\Validator;
class GetLiverInfo extends \App\Inter\AbstractInterfacepublic
{

    public function _verifyInput()
    {
        // TODO: Implement _verifyInput() method.
        $validator = Validator::make(rq(),
            [
                'liver_id' => 'required|integer|exists:livers,id',
            ],[
                'liver_id.required' => '禁播ID不存在',
                'liver_id.exists' => '主播ID不存在'
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
        $ret=$dao->GetLiverInfo(rq('liver_id'));
        if($ret['status'] != 0)
            return err('db error');
        return suc($ret['data']);
    }

}

/**
 *  准备一台服务器（推荐选择腾讯云的“云服务器”服务，并选择服务市场里面的nginx+php+mysql的镜像）
安装mysql5.5以上版本，启动mysql。按照文档createDB.txt 创建db
安装php，修改php配置文件php-fpm.conf中的监听端口（例如demo用的端口是9000，修改 listen = 127.0.0.1:9000, 并运行命令重启服务:service php-fpm restart）
安装nginx ,参照nginx.conf和live_demo.nginx 修改配置，重新reload nginx(运行命令nginx -s reload)
拷贝demo代码到/data目录 （也可以是其他目录，需要响应修改live_demo.nginx的目录位置），并修改live_demo_service/conf/cdn.route.ini中的数据库相关配置（根据createDB.sh中创建的数据库名、用户名及密码等）
在/etc/crontab文件上增加一行配置（此配置的作用是增加一个定时任务，每分钟轮询直播列表中的在线状态，用于清理僵尸频道）：
 * * * * * php /data/live_demo_service/callback/Check_online_status.php
按照上述步骤完成部署后，在浏览器输入http://您的服务器ip/interface.php，如果返回如下结果，说明php部署成功：
{"returnValue":4001,"returnMsg":"json format error","returnData":[]}
 */