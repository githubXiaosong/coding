<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/24
 * Time: 23:00
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

const SEX_UN='0';
const SEX_MAN='10';
const SEX_WON='20';

class Student extends Model
{

//    数据表中必须是created_ad updated_at 但是在view页面调用的时候必须用 create_at 和 update_at




    protected $table='students';

    protected $primaryKey='id';

    public $timestamps=true;

    //指定允许批量赋值的字段
    protected $fillable=['name','age','sex'];

    protected function getDateFormat()//返回的日期
    {
        return time();
    }

    //要对时间所做的处理 不做任何处理返回$val即可
//    protected function asDateTime($val)
//    {
//        return $val
//    }

    public function sex($key=null)
    {
        $arr=[
            SEX_UN=>'未知',
            SEX_MAN=>'男',
            SEX_WON=>'女',
        ];
        if($key!==null){
            if(array_key_exists($key,$arr)){
                return $arr[$key];
            }else{
                return $arr[SEX_UN];
            }
        }
        return $arr[SEX_UN];
    }




}