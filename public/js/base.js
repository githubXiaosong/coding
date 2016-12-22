angular.module('xiaohu',['ui.router','user','question','common','answer'])


    .config([
        '$interpolateProvider',
        '$stateProvider',
        '$urlRouterProvider',
        '$locationProvider',
        function($interpolateProvider
            ,$stateProvider
            ,$urlRouterProvider)
        {
            $interpolateProvider.startSymbol('[:');
            $interpolateProvider.endSymbol(':]');

            $urlRouterProvider.otherwise('/home');

            $stateProvider
                .state('home',{
                    url:'/home',//指定在这个页面之后的路由和对应的在ui-view中的模板
                    templateUrl:'/laravel/xiaohu/public/tpl/page/home'
                })

                .state('login',{
                    url:'/login',
                    templateUrl:'/laravel/xiaohu/public/tpl/page/login' //先在页面的script中寻找这个页面 若没有则像服务器端申请页面
                })

                .state('signup',{
                    url:'/signup',
                    templateUrl:'/laravel/xiaohu/public/tpl/page/signup' //先在页面的script中寻找这个页面 若没有则像服务器端申请页面
                })


                .state('question',{
                    abstract:true,
                    controller:'QuestionController',  //没有html层级关系也可以指定controller 克先执行一遍
                    url:'/question',
                    template:'<div ui-view></div>' //先在页面的script中寻找这个页面 若没有则像服务器端申请页面
                })

            /**
             * 添加问题页面
             */
                .state('question.add',{
                    url:'/add',//这里的/不是相对根目录而是相对上一层
                    templateUrl:'/laravel/xiaohu/public/tpl/page/question/add' //先在页面的script中寻找这个页面 若没有则像服务器端申请页面
                })

            /**
             * 问答详情页面
             */
                .state('question.details',{
                    url:'/details/:id',//这里的/不是相对根目录而是相对上一层
                    templateUrl:'/laravel/xiaohu/public/tpl/page/question/details' //先在页面的script中寻找这个页面 若没有则像服务器端申请页面
                })


            /**
             * 关系问题的一系列controller
             */
                .state('answer',{
                    abstract:true,
                    /**
                     * 若要是想在answer中指定controller 那么必须有这个controller 不然的话就会报错
                     */
                    controller:'AnswerController',
                    url:'/answer',
                    template:'<div ui-view></div>'
                })

                .state('answer.details',{
                    url:'/details?answer_id',
                    //template:'<div>asdasd</div>'
                    templateUrl:'/laravel/xiaohu/public/tpl/page/answer/details'
                })



            /**
             * angular-ui 按照一个页面绑定 通过ui-view一层一层的分发页面的原则 来配置
             *
             * 这里的base.js 和 后端的route.php是相同作用的 并且这里还要指定所有页面的层级关系
             */
                .state('user',{
                    /**
                     * abstract:true 也可包含许多的html 只是必须被继承 不能单独实现
                     * 同时也是需要服务器端来返回数据的 需要在route中注册
                     */
                    abstract:true,
                    url:'/user/:id',//这里的/不是相对根目录而是相对上一层
                    templateUrl:'/laravel/xiaohu/public/tpl/page/user' //先在页面的script中寻找这个页面 若没有则像服务器端申请页面

                })

                .state('user.question',{
                    url:'/question',//这里的/不是相对根目录而是相对上一层
                    templateUrl:'/laravel/xiaohu/public/tpl/page/user/question' //先在页面的script中寻找这个页面 若没有则像服务器端申请页面
                })

                .state('user.answer',{
                    url:'/answer',//这里的/不是相对根目录而是相对上一层
                    templateUrl:'/laravel/xiaohu/public/tpl/page/user/answer' //先在页面的script中寻找这个页面 若没有则像服务器端申请页面
                })


        }])





