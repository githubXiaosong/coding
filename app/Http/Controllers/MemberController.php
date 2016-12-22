<?php
/**
 * Created by PhpStorm.
 * User: Administratsor
 * Date: 2016/10/23
 * Time: 23:38
 */
namespace App\Http\Controllers;

use App\Member;

class MemberController extends Controller{

    public function info(){


        return Member::getMember();


//        return view('member/info',[
//            'name'=>'xiaosong',
//            'age'=>'18'
//        ]);

    }



}