/**
 * Created by Administrator on 2016/12/11.
 */
angular.module('user',[])



    .service('UserService',[
        '$http',
        '$state',
        function($http,$state) { //是在service中注入而不是在下面的函数中注入
            var me=this;//这里this代表自己(User)\

            /**
             * 注册
             */
            me.signup=function()
            {
                //me.signup_data={}; //也可以不指定 在页面的ne-model直接调用的时候 直接被创建 就算是递归的也会创建
                $http.post('/laravel/xiaohu/public/api/user'
                    ,me.signup_data)
                    .then(function(r){
                        if(r.data.status) {
                            $state.go('login');
                        }
                        me.signup_data={};
                    },function(e){
                        console.log(e);
                    })


            }
            /**
             * 判断是否存在
             */
            me.username_exists=function()
            {
                $http.post('/laravel/xiaohu/public/api/user/exists'
                    ,{username:me.signup_data.username})
                    .then(function(r){
                        //suc
                        if(r.data.data.exists)
                            me.signup_username_exists=true;
                        //console.log('true');
                        else{
                            me.signup_username_exists=false;
                            //console.log('false');
                        }
                    }
                    ,function(e){
                        //fail
                        console.log(e);
                    })
            }
            /**
             * 登录
             */
            me.login=function()
            {
                $http.post('/laravel/xiaohu/public/api/login'
                    ,me.login_data)
                    .then(function(r){
                        if(r.data.status) {
                            location.reload();
                            $state.go('home');
                            me.login_data={};
                        }else{
                            me.validateError=true;
                        }
                    }
                    ,function(e){
                        //fail
                        console.log(e);
                    })
            }

            /**
             * 用户详情页用于返回用的综合数据   重构后废弃 不在做统一的数据返回  改为分controller返回数据
             *
             */
            me.getDetails=function($params){
                me.userData=[];
                //me.detail_data={};
                console.log($params);
                $http.post('/laravel/xiaohu/public/api/userdetails  ',$params)
                    .then(
                    function (r) {
                        if(r.data.status)
                        {

                            /**
                             * 还不确定需不需要处理数据
                             */


                            me.userData= r.data.data;
                            console.log(me.userData);
                        }
                    },
                    function (e) {
                        console.log(e);
                    }
                    ).finally(function () {

                    });
            }

            /**
             * 返回用户的信息
             */

            me.getUserInfo= function ($params) {
                $http.post('/laravel/xiaohu/public/api/user/getuserinfo',
                    $params
                ).then(
                    function ($r) {
                        me.userInfo=$r.data.data;
                    },
                    function ($e) {
                        console.log(e);
                    }).finally(function () {

                    })
            }

            /**
             * 返回用户问题
             */
            me.questions=[];
            me.getQuestion= function ($params) {
                /*
                 * 表明当前所在页面
                 */
                me.currentPage=1;
                $http.post('/laravel/xiaohu/public/api/getuserquestion',
                    $params).then(
                    function ($r) {
                        me.questions=$r.data.data;
                    },
                    function ($e) {
                        console.log($e);
                    })
                    .finally(function () {

                    })
            }

            /**
             * 返回用户回答和相关问题
             */
            me.answers=[]
            me.getAnswer= function ($params) {
                /*
                 * 表明当前所在页面
                 */
                me.currentPage=2;
                $http.post('/laravel/xiaohu/public/api/getuseranswer',
                    $params).then(
                    function ($r) {
                        me.answers=$r.data.data;
                    },
                    function ($e) {
                        console.log($e);
                    })
                    .finally(function () {

                    })
            }






        }
    ])



    /**
     * 初测方法
     */
    .controller('SignupController',[
        '$scope',
        'UserService',//xxxService不带$
        function($scope,UserService)
        {
            //因为直接在页面中找任何Service都是找不到的 但是在js文件都是相互可见的 只有绑定到对应的controller的scope下面才能在页面中使用
            $scope.User=UserService;
            $scope.$watch(
                function(){
                    //应该返回要监听的数据模型  最好直接写要要监听数据 不要写外层的数据
                    return UserService.signup_data;
                }
                ,function(n,o){
                    //发生变化的时候要做什么  n o为新旧数据模型的注入
                    UserService.username_exists();
                },true)//是否递归监控数据模型中的所有数据
        }

    ])
    //.service('UserService',function(){    以这个方式若在function中注入参数的时候会有一些问题 就是在上传到服务器进行和压缩的时候变量名会改变所以angluar会不认识
    //
    //});
    /**
     * 登录方法
     */
    .controller('LoginController',[
        '$scope',
        'UserService',
        function($scope,UserService)
        {
            $scope.User=UserService;

        }
    ])


    /**
     * User页面组的所有的controller
     */
    .controller('UserController',[
        '$scope',
        'UserService',
        '$stateParams',
        function ($scope,UserService,$stateParams) {
            $scope.User=UserService;
            $scope.userid=$stateParams.id;
            UserService.getUserInfo($stateParams);
            /**
             * 在页面中用的话不需要加scope可以直接用 在js代码中用的话则需要加scope 可以直接用
             */
        },

    ])
    /**
     * User组的Question
     */
    .controller('UserQuestionController',[
        '$scope',
        function ($scope) {
            $scope.User.getQuestion({id:$scope.userid});
        }
    ])
    /**
     * User组的Answer
     */
    .controller('UserAnswerController',[
        '$scope',
        function ($scope) {
            $scope.User.getAnswer({id:$scope.userid});
        }
    ])




