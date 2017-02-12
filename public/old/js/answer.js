angular.module('answer',[])
    .service('AnswerService',[
         '$http',
        '$state',
         function ($http,$state) {
             var his={
                 id:$('html').attr('user-id')
             }




             var me=this;
             /**
              * 提取answer数据中的vote  给answer设置timesUp/timeDown 和 根据用户的判断是否投过票 来决定按钮的显示情况
              * @param answer
              * @
              */
             me.getVote = function (answer) {
                 var data=[];
                 var timesUp=0;
                 var timesDown=0;
                for(var key in answer.users)
                {


                    if(answer.users[key].pivot.vote==1) {
                        timesUp++;

                        if(answer.users[key].pivot.user_id==his.id)
                        {
                                answer.hasUp=true;
                        }
                    }
                    if(answer.users[key].pivot.vote==2) {
                        timesDown++;

                        if(answer.users[key].pivot.user_id==his.id)
                        {
                                 answer.hasDown=true;
                        }
                    }

                }
                 answer['timesUp']=timesUp;
                 answer['timesDown']=timesDown;

            }
             /**
              *  传入vote 调用服务器接口 并且更新页面
              * @param vote,answer_id,data,四个对应页面执行的函数 1点击支持对应数据变化 2点击反对对应数据变化 3支持函数服务器错误rollback 4反对函数服务器错误rollback
              *
              * @returns {number}  成功返回0 失败返回-1
              */
             me.setVote = function (vote,answer_id,data,funcVoteUp,funcVoteDown,funcNVoteOn,funcNVoteDown,funcAnswer)
             {

                 /**
                  * 没有登录直接T
                  */
                 if(!his.id) {
                     $state.go('login');
                     return;
                 }


                 /**
                  * 先执行逻辑若返回结果不是1 怎反执行逻辑
                  */
                 var answerid;
                 for(var key in data)
                 {
                     answerid=funcAnswer(key);
                     if(answerid==answer_id)
                     {
                         //不应该把值传过去 尽量的做到算法和数据结构和逻辑分离
                         if(vote==1)
                             funcVoteUp(key);

                         if(vote==2)
                             funcVoteDown(key);
                         break;
                     }
                 }

                 $http.post('/laravel/xiaohu/public/api/answer/vote'
                     ,{'vote':vote,'id':answer_id}
                 ).then(
                     function (r) {
                         /**
                          *
                          */
                        if(r.data.status!=1){
                            /**
                             * 若逻辑返回值不是1怎反执行逻辑
                             */
                            for(var key in data)
                            {
                                answerid=funcAnswer(key);
                                if(answerid==answer_id)
                                {
                                    if(vote==1)
                                        funcNVoteOn(key);

                                    if(vote==2)
                                        funcNVoteDown(key);
                                    break;
                                }
                            }
                            console.log(r);
                            return data;
                        }else if(r.data.status==1){
                            console.log(r);
                        }
                     },
                     function (e) {
                         console.log(e);
                     }
                 ).finally(function () {

                     })

                 return 0;
             }


             /**
              * 加载问题和回答的数据进来
              */
             me.question={};
             me.answer={};

             me.getAnswerAnQuestion= function ($params) {
                 $http.post('/laravel/xiaohu/public/api/getanswerandquestion'
                     ,$params
                 ).then(
                     function (r) {
                         console.log(r);
                     },
                     function (e) {
                         console.log(e);
                     }
                 ).finally(
                     function () {

                     })
             }


             /**
              * 得到分页返回评论数据 上来先加载一次
              */
             me.comments=[];
             me.getComments= function ($params,$page) {
                 $http.post('/laravel/xiaohu/public/api/getcomments'
                     ,{'answer_id':$params.answer_id ,'page':$page}
                 ).then(
                     function (r) {
                         console.log(r);
                     },
                     function (e) {
                         console.log(e);
                     }
                 ).finally(
                     function () {

                     })
             }



        }
    ])


    .controller('AnswerController',[
        '$scope',
        'AnswerService',
        function ($scope, AnswerService) {
            $scope.Answer=AnswerService;
        }
    ])
    
    .controller('AnswerDetailsController',[
        '$scope',
        '$stateParams',
        function ($scope, $stateParams) {
            /**
             * 单次查询问题和答案  分页查询评论列表  加载先执行一次再说
             */
            $scope.Answer.getAnswerAnQuestion($stateParams);
            $scope.Answer.getComments($stateParams,1);
        }
    ])






