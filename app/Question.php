<?php

namespace App;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;


class Question extends Model
{

    public function add()
    {
        //是否登陆
        $userid=userins()->is_login();
        if(!$userid)
            return ['status' => 0, 'msg' => 'please login first'];


        //是否有问题
        if(! rq('title') )
            return ['status'=>0,'msg'=>'that no title!'];



        //验证
        $validator = Validator::make(rq(),
            [
                'title' => 'required|min:5|max:64',
                'desc'  => 'max:2000'
            ],
            [
                'title.required'=>'title required',
                'title.min'=>'title too short',
                'title.max'=>'title too max',
                'desc.max'=>'desc too max',
            ]);

        if( $validator->fails() )
            return ['status' => 2, 'msg' => $validator->messages()];


        //存储
        $this->title=rq('title');
        $this->desc=rq('desc');
        $this->user_id=$userid;
        if(! $this->save())
            return ['status' => 0, 'msg' => 'datebase faile!'];
        return ['status' => 1, 'msg' => 'it is ok','user_id'=>$userid];
    }

    public function change()
    {
        if(!userins()->is_login())
            return ['status' => 0, 'msg' => 'please login first'];

        //判断并接收问题
        $question=$this->have_id_and_question();
        if(!$question)
            return ['status' => 0, 'msg' => 'no question or id'];

        if($question->user_id!=session('user_id'))
            return ['status' => 0, 'msg' => 'permission defined'];

        if(rq('title'))
            $question->title=rq('title');

        if(rq('desc'))
            $question->desc=rq('desc');

        //验证
        $validator = Validator::make(rq(),
            [
                'title' => 'required|min:5|max:64',
                'desc'  => 'max:2000'
            ],
            [
                'title.required'=>'title required',
                'title.min'=>'title too short',
                'title.max'=>'title too max',
                'desc.max'=>'desc too max',
            ]);

        if( $validator->fails() )
            return ['status' => 2, 'msg' => $validator->messages()];

        if($question->save())
            return ['status' => 1, 'msg' => 'change question success'];
        else
            return ['status' => 0, 'msg' => 'db failed'];
    }


    public function read()
    {
        $question=$this->have_id_and_question();
        //存在问题 返回 一条
        if($question)
            return ['status'=>1,'data'=>$question];

        //不存在 按页面返回

        //限制长度

        $limit=get_limit_and_skip(rq('limit'))['limit'];
        $skip=get_limit_and_skip(rq('limit'))['skip'];

        $r= $this->orderBy('created_at')
            ->limit($limit)
            ->skip($skip)
            ->get()
            ->keyBy('id');

        return ['status'=>1,'data'=>$r];
    }

    public function remove()
    {
        if(!userins()->is_login())
            return ['status'=>0,'msg'=>'please login first'];
        $question=$this->have_id_and_question();
        if(!$question)
            return ['status'=>0,'msg'=>'no id or question'];
        if(session('user_id') != $question->user_id)
            return ['status'=>0,'msg'=>'permission denied'];
        return $question->delete() ? ['status'=>1,'succeed'] : ['status'=>0,'db delete failed'];
    }


    //没有id和问题返回false 有返回$question
    public function have_id_and_question($_id=null)
    {
        $id=$_id ? :rq('id');
        if(!$id)
            return null;
        return  $this->where('id',$id )->with('user')->first()?:null;
    }


    public function user()
    {
        return $this
            ->belongsTo('App\User');
    }

    /**问题所对应的答案
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this
            ->hasMany('App\answer');
    }

    /**问题所对应的答案以及答案的点赞和用户信息
     * @return
     */
    public function answers_user_users()
    {
        return $this
            ->answers()
            ->with('user')
            ->with('users');
    }






}
