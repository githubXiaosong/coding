<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/24
 * Time: 23:00
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public static function getMember(){
        return 'member name is xiaosong';
    }
}