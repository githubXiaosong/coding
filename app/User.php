<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Request;
use Illuminate\Support\Facades\Validator;

class User extends Model
{

    /*注册 API*/
    public function signup()
    {
      if(!$this->has_usernameOrphone_and_password())
          return err('the phone or username is requied');


        $password=rq('password');
        /* 用户名是否存在*/

        $validator=Validator::make(
            rq(),
            [
                'username'=> 'unique:users,username|min:5|max:255',
                'phone'=> 'unique:users,phone|min:5|max:11',
                'password'=> 'min:6|max:24|alpha_dash'
            ],
            [
                'username.unique'=>'username is exists',
                'username.min'=>'username is too short',
                'username.max'=>'username is too long',
                'password.min'=>'password is too short',
                'password.max'=>'password is too long',
                'username.alpha_dash'=>'password format is not allowed'
            ]
        );

//        dd(rq());

        if($validator->fails())
            return ['status'=>0,'msg'=>$validator->messages()];

        /* 加密密码*/

        $hashed_password=Hash::make($password);
        $user=$this;
        $user->password=$hashed_password;
        if(rq('username'))
            $user->username=rq('username');
        if(rq('phone'))
            $user->phone=rq('phone');
        if($user->save())
            return ['status'=>1,'msg'=>'succeed signup','id'=>$user->id];
        else
            return  ['status'=>0,'msg'=>'db insert failed'];
        /* 存入数据库*/

        dd($hashed_password);
    }

    /*登陆API*/
    public function login()
    {
        /*检查 用户名 和 密码 是否 存在*/

        if($this->is_login())
            return ['status'=>0,'msg'=>'you had login please logout first!'];
        $check= $this->has_usernameOrphone_and_password();
        if(!$check)
            return ['status'=>1,'msg'=>'username or password can not be empty!'];

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

        return   redirect()->back();

    }


    public function change_password()
    {

//      判断登录
        if(!userins()->is_login(2))
           return err('no login');
        $this->reset_last_time();

//      是不是同时有旧密码和新密码
        if(!rq('oldpassword') || !rq('newpassword'))
           return err('no newpassword or oldpassword');

//      旧密码对不对
        $user=userins()->find(session('user_id'));

        if(!Hash::check(rq('oldpassword'),$user->password))
            return err('the old password is not true');

//      新密码合不合法

        $validator=Validator::make(
            rq(),
            [
                'newpassword'=> 'min:8|max:24|alpha_dash'
            ],
            [
                'newpassword.min' => 'newpassword is too min',
                'newpassword.max' => 'newpassword is too long',
                'newpassword.alpha_dash' => 'newpassword alpha_dash'
            ]
        );

        if($validator->fails())
            return err('error',['data'=>$validator->messages()]);

//      判断保存 返回数据
        $user->password=Hash::make(rq('newpassword'));

        if(!$user->save())
            return err('db error');
        return suc();

    }

    public function resetPassword_send()
    {
        if($this->is_robot())
            return err('max frequency');
        $this->reset_last_time();

//        检查是不是有手机号
        if(!rq('phone'))
            return err('no phone number');
//        检查手机号是不是在数据库中存在
        $user=$this->where(['phone'=>rq('phone')])->first();
        if(!$user)
            return err('the phone is not true or you not have any phone for this web');
//        生成验证码
        $captcha=$this->generateCaptche();

//        储存验证码
        $user->captcha=$captcha;
        if(!$user->save())
            return err('db error');
    //        发送验证码
        $this->doSend($captcha);
        return suc();
    }

    public function resetPassword_validate()
    {
        if($this->is_robot())
            return err('max frequency');
        $this->reset_last_time();


        /*检查传入参数是否同时有phone captcha newpassword*/
        if(!rq('phone') || !rq('captcha') || !rq('newpassword'))
            return err('the phone and captcha and newpassword is required');
        /*检查phone和captcha是否对应一个user*/
        $user=$this->where(['phone'=>rq('phone'),'captcha'=>rq('captcha')])->first();
        if(!$user)
            return err('the captcha is required');
        /*新密码的合法性*/
        Validator::make(rq(),
            [
                'newpassword'=>'min:5|max:16|alpha_dash|required'
            ],
            [
                'newpassword.min'=>'the password is too min',
                'newpassword.max'=>'the password is too max',
                'newpassword.required'=>'the password is required',
                'newpassword.alpha_dash'=>'the password format is error'
            ]);
        /*user赋值加密后的密码*/
        $user->password=Hash::make(rq('newpassword'));
        /*保存 返回json*/
        return $user->save()
            ? suc()
            : err('db insert error');

    }

    public function doSend($captcha)
    {
        /* 测试方法  接口执行 */
        return true;
    }

    public function generateCaptche()
    {
        return rand(1000,9999);
    }

    public function has_usernameOrphone_and_password()
    {
        if(!rq('password'))
            return false;
        if(!(rq('username') || rq('phone')))
            return false;
        return true;

    }



    /*检测用户是否登陆*/
    public function is_login()
    {

        return session('user_id')?:false;

    }




//    检查是不是机器人
    public function is_robot($time=10)
    {
        if(!session('last_time'))
        {
            session()->put('last_time', time());
            return false;
        }
        $current_time=time();
        return (($current_time-session('last_time'))<$time );
    }

//    重置last_time
    public function reset_last_time()
    {
        session()->put('last_time',time());
    }


    public function get_userInfo()
    {
//        有没有用户ID
        if(!rq('id'))
            return err('no user_id');
//        有没有对应用户
        $get=['id','username','avatar_url','email','phone'];
        $user=$this->find(rq('id'),$get);
        if(!$user)
            return err('no that user');
//        查询出来
//            查询出vote数组

        /**
         * 暂时先不反悔点赞 数据 或者不在此处返回点赞数据
         */
//        $vote=$user
//            ->answers()
//            ->newPivotStatement()
//            ->where(['user_id'=>rq('id')])
//            ->orderBy('created_at','desc')
//            ->get();

        $data=$user->toArray();
        $data['question_num']=quesins()->where(['user_id'=>rq('id')])->count();
        $data['answer_num']=answerins()->where(['user_id'=>rq('id')])->count();
        $data['question_focus']=$user->questions()->count();
//        $data['answer_vote']=$vote;
//        返回数据


        return suc($data);
    }


    public function exists()
    {
        if(!rq('username'))
            return err('no username');
        $r=$this->where(['username'=>rq('username')])->first();

        return suc(['exists'=>$r?true:false]);
    }

    public function answers()
    {
        return $this
            ->belongsToMany('App\Answer')
            ->withPivot('vote')
            ->withTimestamps();
    }

    public function questions()
    {
        return $this
            ->belongsToMany('App\Question')
            ->withPivot('is_focus')
            ->withTimestamps();
    }
//    关注和取消关注

}
