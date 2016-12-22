/**
 *
 * Created by Administrator on 2016/12/11.
 */
angular.module('common',['answer'])

    .service('TimelineService',[
        '$http',
        'AnswerService',

        /**
         *  点赞功能是不是不该这么做?应该的问题表中有个字段？？？
         * @param $http
         * @param AnswerService
         */
        function ($http,AnswerService) {
            var me=this;
            me.data=[];
            me.currentPage=1;
            me.isBusy=false;
            me.noMore=false;
            /**
             * 从服务器获取数据 新的交给answerService处理一下vote问题然后合并一下
             */
            me.getData= function () {
                if(me.isBusy==true)
                    return;
                me.isBusy=true;

                if(me.noMore==true)
                    return;
                $http.post('/laravel/xiaohu/public/api/timeline'
                    ,{'page':me.currentPage}
                )
                    .then(function (r) {
                        if(r.status) {
                            if(r.data.data.length == 0)
                                me.noMore=true;
                            for(var key in r.data.data) {
                                /**
                                 * 传入新的数据answerService 给新的数据进行计算vote赋值 然后判断有没有投过票 来决定 按钮的状态
                                 */
                                AnswerService.getVote(r.data.data[key].answer);
                            }
                            me.data = me.data.concat(r.data.data);
                            me.currentPage++;
                            console.log(me.data);
                        }else
                            console.log('Server Error');
                    }, function (e) {
                        console.log(e);
                    }).finally(function () {
                        me.isBusy=false;
                    })
            }

            /**
             * 传入vote,answer_id 在之中更新data
             * @param vote,answer_id
             */


            me.setVote= function (vote,answer_id) {
                /**
                 * AnswerService 可以统一处理getVote返回数据  但是AnswerService中的setVote方法和home页面的数据是耦合的 无法进行复用
                  */
                AnswerService.setVote(vote,answer_id,me.data,
                    function (key) {
                        me.data[key].answer.hasUp=true;
                        me.data[key].answer.hasDown=false;
                        me.data[key].answer['timesUp']++;
                        me.data[key].answer['timesDown']--;
                    },
                    function (key) {
                        me.data[key].answer.hasUp=false;
                        me.data[key].answer.hasDown=true;
                        me.data[key].answer['timesUp']--;
                        me.data[key].answer['timesDown']++;
                    },
                    function (key) {
                        me.data[key].answer.hasUp=false;
                        me.data[key].answer.hasDown=true;
                        me.data[key].answer['timesUp']--;
                        me.data[key].answer['timesDown']++;
                    },
                    function (key) {
                        me.data[key].answer.hasUp=true;
                        me.data[key].answer.hasDown=false;
                        me.data[key].answer['timesUp']++;
                        me.data[key].answer['timesDown']--;
                    },
                    function (key) {
                        return me.data[key].answer.id;
                    }
                );
            }

        }
    ])





    .controller('HomeController',[
        '$scope',
        'TimelineService',
        function ($scope,TimelineService) {
            var $win;
            $scope.Timeline=TimelineService;
            TimelineService.getData();

            $win=$(window);
            $win.on('scroll', function () {
                if( ($win.scrollTop() - ( $(document).height() - $win.height() ) )  > -5 ){
                    TimelineService.getData();
                }
            })
        }
    ])



