<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/30
 * Time: 0:10
 */

namespace App\Http\Middleware;


use Closure;


//closure   关闭
//guard     警卫 守卫
//time()<strtotime('2016-06-05') 字符串变换为时间戳格式

//中间件的文件名和类名都大写 注册时候的名字要和在路由调用的时候相同 因为路由是从配置文件中读取操作的

class Activity
{

//    前置中间件 $next()代表访问主体 把request传给$next()就代表过滤通过
    public function handle($request,Closure $next)
    {
        //中间件 执行判断
        if(time()<strtotime('2016-11-05'))
        {
            return redirect('activity0');
        //中间件不起作用
        }else{
            return $next($request);
        }
    }


//后置中间件
//
//    public function handle($request,Closure $next)
//    {
//        $response=$next($request);
//
//    }
}

