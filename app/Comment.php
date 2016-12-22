<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

//评论的是多种的   同时可以针对问题 回答   同时也可以针对评论
class Comment extends Model
{

    public function add()
    {
        //是否登录
        if(! userins()->is_login())
            return ['status'=>0,'please login first'];

//        是否有同时有问题ID和回答ID或者同时没有问题ID和回答ID
        if( (rq('question_id') && rq('answer_id')) || (!rq('question_id') && !rq('answer_id')) )
            return ['status'=>0,'tow or zeros'];

//      是否有内容
        if(!rq('content'))
            return ['status'=>0,'msg'=>'there is no content'];

//      数据验证
        $validator=Validator::make(rq(),
            [
                'content'=>'required|min:1|max:255'
            ],
            [
                'content.required'=>'content is required',
                'content.min'=>'content is too min',
                'content.max'=>'content is too long'
            ]);
        if($validator->fails())
            return ['status'=>2,'data'=>$validator->messages()];

        if(rq('question_id'))
        {
            //        问题ID
            //            是否有这个问题
            if(! quesins()->find(rq('question_id')))
                return ['status'=>0,'msg'=>'no question id'];
            $this->question_id=rq('question_id');

        }else if(rq('answer_id')){
//            回答ID
            //            是否有这个回答
            if(! answerins()->find(rq('answer_id')))
                return ['status'=>0,'msg'=>'no answer id'];
            $this->answer_id=rq('answer_id');
        }else
            return ['status'=>0,'msg'=>'permission denied'];


//        有没有评论ID
        if(rq('comment_id')){
//            检查有没有这条评论
            $target=$this->find(rq('comment_id'));
            if(!$target)
                return ['status'=>0,'msg'=>'no commnent'];
//        是不是在回答自己的评论
            if($target->user_id==session('user_id'))
                return ['status'=>0,'msg'=>'can not comment yourself'];
            $this->comment_id=$target->id;

        }


//        保存数据
        $this->user_id=session('user_id');
        $this->content=rq('content');

        if(!$this->save())
            return ['status'=>0,'msg'=>'can not save because bd'];
        return ['status'=>1,'msg'=>'succeed'];
    }


    /**
     * 根据回答的ID或者评论的ID返回 评论和对应用户
     * @return array
     */
    public function read()
    {
        if( (rq('question_id')&&rq('answer_id')) || (!rq('question_id')&&!rq('answer_id')) )
            return ['status'=>'0','msg'=>'tow or zero'];
        if(rq('question_id'))
        {
            $question=quesins()->find(rq('question_id'));
            if(!$question)
                return ['status'=>'0','msg'=>'no that question'];
            $data=$this->where(['question_id'=>rq('question_id')])->with('user');
        }else{
            $answer=answerins()->find(rq('answer_id'));
            if(!$answer)
                return ['status'=>'0','msg'=>'no that answer'];
            $data=$this->where(['answer_id'=>rq('answer_id')])->with('user');
        }
        return ['status'=>'1','data'=>$data->get()->keyBy('id')];

    }

    public function remove()
    {
//        验证登录
        if(!userins()->is_login())
            return ['status'=>'0','msg'=>'no login'];
//        是否有传过来ID
        if(!rq('id'))
            return ['status'=>'0','msg'=>'no id'];
//        ID是否对应着评论
        $comment=$this->find(rq('id'));
        if(!$comment)
            return ['status'=>'0','msg'=>'the comment is not exist'];
//        权限
        if($comment->userid!=session('user_id'))
            return ['status'=>'0','msg'=>'permission denied'];
//        删除子评论
        $this->where(['comment_id'=>rq('id')])->detele();
//        删除评论
        return $this->delete() ? ['status'=>'1','msg'=>'ok'] : ['status'=>'0','msg'=>'db insert fail'];

    }


    public function user()
    {
        return $this
            ->belongsTo('App\User');
    }



}
