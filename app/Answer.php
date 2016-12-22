<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Answer extends Model
{
    public function add()
    {
        //是不是登陆了
        if( ! userins()->is_login())
            return ['status'=>0,'msg'=>'please login first'];
        //有没有问题ID和问题ID是否对应问题
        if( !quesins()->have_id_and_question(rq('question_id')))
            return ['status'=>0,'msg'=>'that no question or question_id'];
        //有没有内容
        if( !rq('content') )
            return ['status'=>0,'msg'=>'that no content'];

        //有没有重复
        if($this->where(['user_id'=>session('user_id'),'question_id'=>rq('question_id')])->count()>2)
            return  ['status'=>0,'msg'=>'the answer can not over 3 times'];

        //验证
        $validator=Validator::make(rq(),
            [
                'content' => 'required | min :5 | max:1024'
            ],
            [
                'content.min' => 'content too min',
                'content.max' => 'content too long'
            ]);
        if($validator->fails())
            return ['status' => 2, 'msg' => $validator->messages()];

        $this->content=rq('content');
        $this->user_id=session('user_id');
        $this->question_id=rq('question_id');

        if(! $this->save())
            return ['status' => 0, 'msg' => 'datebase faile!'];
        return ['status' => 1, 'msg' => 'it is ok','answer_id'=>$this->id];

    }

    public function change()
    {
        //是否登陆
        if(!userins()->is_login())
            return ['status'=>0,'msg'=>'please login first'];
        //有没有回答ID和回答
        $answer=$this->have_id_and_answer();
        if(!$answer)
            return ['status'=>0,'msg'=>'that no id or answer'];
        //有没有权限
        if($answer->user_id!=session('user_id'))
            return ['status'=>0,'msg'=>'permission denied'];
        //内容合法
        $validator=Validator::make(rq(),
            [
                'content' => 'required | min :5 | max:1024'
            ],
            [
                'content.min' => 'content too min',
                'content.max' => 'content too long'
            ]);
        if($validator->fails())
            return ['status'=>2,'msg'=>$validator->messages()];

        if(rq('content'))
            $answer->content=rq('content');

        if($answer->save())
            return ['status' => 1, 'msg' => 'change answer success'];
        else
            return ['status' => 0, 'msg' => 'db failed'];

    }

    public function read()
    {

        //有没有ID
        if(rq('id'))
        {
            //有没有对应回答
            $answer=$this->find(rq('id'));
            if(!$answer)
                return ['status' => 0, 'msg' => 'this no answer'];
            return ['status' => 1, 'data' => $answer];

        }else{
            if(!rq('question_id'))
                return ['status' => 0, 'msg' => 'the question_id or id is required'];
            if(!quesins()->find(rq('question_id')))
                return ['status' => 0, 'msg' => 'the question is not exists'];
            //限制长度
            $limit=get_limit_and_skip(rq('limit'))['limit'];
            //哪一页
            $skip=get_limit_and_skip(rq('limit'))['skip'];
            $answers=$this
                ->where(['question_id'=>rq('question_id')])
                ->limit($limit)
                ->skip($skip)
                ->get()
                ->keyBy('id');
            return ['status' => 1, 'data' => $answers];
        }
    }

    public function remove()
    {
        //检查是否登陆
        if(!userins()->is_login())
            return ['status'=>0,'msg'=>'please login first'];
        //检查是否有传递id和是否有回答
        $answer=$this->have_id_and_answer();
        if(!$answer)
            return ['status'=>0,'msg'=>'no id or answer'];
        //检查权限
        if(session('user_id') != $answer->user_id)
            return ['status'=>0,'msg'=>'permission denied'];
        //操作db
        if(!$answer->delete())
            return ['status'=>0,'msg'=>'db fail'];
        return ['status'=>1,'msg'=>'delete succeed'];
    }


    public function have_id_and_answer()
    {
        if(!rq('id'))
            return null;
        return $this->find(rq('id'))?:null;
    }

    public function vote()
    {
        //检测是否登录
        if(!userins()->is_login())
            return ['status'=>0,'msg'=>'please login in first'];
        //检测是否有ID和vote
        if(!rq('id') || !rq('vote'))
            return ['status'=>0,'msg'=>'the id and vote is required'];
//        ID有没有对应 问题
        $answer=$this->find(rq('id'));
        if(!$answer) return ['status'=>0,'msg'=>'no answer'];
// 如果 vote 小于 1 对应1   不是一对应2
        $vote =rq('vote') <=1 ? 1 :2;

        $data=$answer
            ->users()
            ->newPivotStatement()
            ->where('user_id',session('user_id'))
            ->where('answer_id',rq('id'))
            ->where('vote',rq('vote'))
            ->first();
        if($data){
            return ['status'=>3,'msg'=>'it is tow same vote'];
        }

//      不管有没有顶或者踩  都删除 然后写入
        $answer
            ->users()
            ->newPivotStatement()
//            从这里开始就进入了另一个数据模型了    进入的是那个中间的数据模型   就是轴模型 对应轴表
            ->where('user_id',session('user_id'))
            ->where('answer_id',rq('id'))
            ->delete();
//      绑定参数

//        此句就可以直接存储 数据和绑定参数了
//        两个外键分别对应中间轴的'两端' 因为是从一个数据模型中来 所以就已经绑定了一个参数了 这里需要在attach 方法中在第一个参数中传入另一个 '轴的一端' 在第二个参数中传入一个其他属性参数的数组
//        从一个数据模型中来 就已经绑定了一个参数了 另一个 采纳数
        $answer->users()->attach(session('user_id'),['vote'=>rq('vote')]);

//      返回数据
        return ['status'=>1];


    }



    public function users()  //这个方法本质上就是返回对应的一对一或者一对多的数据模型 然后在其他的方法中去调用而已
    {
        return $this
            ->belongsToMany('App\User')     //本质上描述的是一种关系 belongsToMany描述的一对多的关系  belongTo描述的是一种一对一的关系 调用的时候就会返回相应的对象
            ->withPivot('vote')
            ->withTimestamps();
    }


    public function user()
    {
        return $this
            ->belongsTo('App\User');
    }


    public function question()
    {
        return $this
            ->belongsTo('App\Question');
    }




}
