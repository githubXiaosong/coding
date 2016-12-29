<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class User
 * @package App
 *
 * 0 关注
 * 1 主播
 */
class User extends Model
{

    /**
     * @return array
     * 只能用手机号注册
     */
    public function signup()
    {

        /**
         *
         */
        if(!rq('phone') || !rq('password'))
            return err('no phone or passwrod');

        $password=rq('password');
//
        $validator=Validator::make(
            rq(),
            [
                'username'=> 'unique:users,username|min:5|max:255',
                'phone'=> 'unique:users,phone|min:5|max:11|required',
                'password'=> 'min:6|max:24|alpha_dash|required',
                'desc'=>'max:255',
                'avatar_url'=>'active_url'
            ],
            [
                'username.unique'=>'用户名已存在',
                'username.min'=>'用户名长度不符合规则',
                'username.max'=>'用户名长度不符合规则',
                'password.min'=>'密码长度不符合规则',
                'password.max'=>'密码长度不符合规则',
                'username.alpha_dash'=>'用户名不合法',
                'phone.unique'=>'该数据号已经被注册',
                'desc.max'=>'描述的长度过长',
                'avatar_url.active_url'=>'图片不合法'
            ]
        );

//
        if($validator->fails())
            return ['status'=>0,'msg'=>$validator->messages()];
//        /* 加密密码*/

        $hashed_password=Hash::make($password);
        $user=$this;
        $user->password=$hashed_password;
        if(rq('username'))
            $user->username=rq('username');
        if(rq('phone'))
            $user->phone=rq('phone');
        if(rq('desc'))
            $user->desc=rq('desc');
        if(rq('avatar_url'))
            $user->avatar_url=rq('avatar_url');
        $user->status=1;
//
        if($user->save())
            return ['status'=>1,'msg'=>'succeed signup','id'=>$user->id];
        else
            return  ['status'=>0,'msg'=>'db insert failed'];
    }

    /*登陆API*/
    public function login()
    {
        /*检查 用户名 和 密码 是否 存在*/
        if($this->is_login())
            return ['status'=>0,'msg'=>'you had login please logout first!'];

        if( !( (rq('username') || rq('phone')) && rq('password') ) )
            return err('username or phone and password is required');


        $password=rq('password');

        $user=null;

        if(rq('username'))
            $user=$this->where('username',rq('username'))->first();
        else
            $user=$this->where('phone',rq('phone'))->first();


        if(!$user)
            return ['status'=>0,'msg'=>'the user is not exits'];
        /*检查密码是否正确*/
        $hashed_password=$user->password;
        if( ! Hash::check($password,$hashed_password)) //一参传过来的password 未加密  二参 加密的密码
            return ['status'=>0,'msg'=>'the password is error'];
        /*登陆成功 写入session*/
        session()->put('username',rq('username'));
        session()->put('user_id',$user->id);

//        dd(session()->all());

        return ['status'=>1,'id'=>session('user_id')];
    }

    /*用户登出*/
    public function logout()
    {
//        session()->flush();//清空session
        if(!session('user_id'))
            err('you have not login ');
        session()->forget('username');
        session()->forget('user_id');

        return   suc();
    }


    public function is_login()
    {
        if(!session('user_id'))
            return false;
        return session('user_id');
    }


}
