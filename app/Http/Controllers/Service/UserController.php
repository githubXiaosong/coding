<?php

namespace App\Http\Controllers\Service;

use App\Helper\GlobalFunction;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;

class UserController extends Controller
{

    const DB_ERROR = 3;
    public function register()
    {
        $validator = Validator::make(
            rq(),
            [
                'phone' => 'required|unique:users,phone|min:11|max:11',
                'password' => 'required|min:6|max:24|alpha_dash',
                'code' => 'required|min:4|max:4'
            ],
            [
                'phone.unique' => '手机号已被注册',
            ]
        );
        if ($validator->fails())
            return GlobalFunction::returnModel(2, $validator->messages());
        if (!$this->validateSMS())
            return GlobalFunction::returnModel(1, ['code' => [0 => '验证码有误']]);
        $hashed_password = Hash::make(rq('password'));
        $user = new User();
        $user->password = $hashed_password;
        $user->phone = rq('phone');
        if ($user->save())
            return GlobalFunction::returnModel(0, 'succeed signup', ['user_id' => $user->id]);
        else
            return GlobalFunction::returnModel(self::DB_ERROR, 'db error');
    }

    public function login()
    {
        $validator = Validator::make(
            rq(),
            [
                'phone' => 'required|min:11|max:11',
                'password' => 'required|min:6|max:24|alpha_dash',
                'code' => 'required|min:4|max:4'
            ],
            [
            ]
        );
        if ($validator->fails())
            return GlobalFunction::returnModel(1, $validator->messages());
        if (!$this->validateCode())
            return GlobalFunction::returnModel(2, ['code' => [0 => '验证码有误']]);
        $users = DB::table('users')
            ->where(['phone' => rq('phone')])
            ->first();
        if (!$users)
            return GlobalFunction::returnModel(3, ['user' => [0 => '用户不存在']]);
        if (!Hash::check(rq('password'), $users->password)) //一参传过来的password 未加密  二参 加密的密码
            return GlobalFunction::returnModel(4, ['password' => [0 => '密码错误']]);
        Session::put('user', $users);
        return GlobalFunction::returnModel(0);
    }


    public function logout()
    {
//        dd(Session::all());
        Session::flush();
        return redirect('home');
    }

    protected function validateCode()
    {
        if (rq('code') == Session::get('validateCode'))
            return true;
        return false;
    }


    protected function validateSMS()
    {

        if (rq('code') == Session::get('sendSMSCode'))
            return true;
        return false;
    }

}
