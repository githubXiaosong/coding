<!doctype html>
<html lang="zh" ng-app="xiaohu" user-id="{{session('user_id')}}">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    {{--默认是从public目录开始的  /就是跟目录的--}}
    <link rel="stylesheet" href="lib/normalize/normalize.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/base.css">
    <script src="lib/jquery/jquery.js"></script>
    <script src="lib/angular/angular.min.js"> </script>
    <script src="lib/angular-ui-route/release/angluar-ui-route.js"></script>
    <script src="js/base.js"></script>
    <script src="js/user.js"></script>
    <script src="js/question.js"></script>
    <script src="js/common.js"></script>
    <script src="js/answer.js"></script>
    <script src="js/user.js"></script>

</head>
<body>
    <div class="navbar clearfix navbar-fixed-top">
        <div class="fl navbar-item">
            <div>
            <a class="navbar-item brand"  href="#home">晓乎</a>
                <form ng-controller="QuestionController" id="topForm" ng-submit="Question.go_add_question()">
                    <input  type="text" ng-model="Question.add_data.title">
                    <button   type="submit">提问</button>
                </form>
            </div>
        </div>

        <div class="fr" >

            <ul class="nav nav-tabs">
              <li >  <a class="navbar-item" href="#home">首页</a> </li>
                @if(!isLogin())
                    <li>    <a class="navbar-item" href="#login">登录</a> </li>
                    <li>    <a class="navbar-item" href="#signup">注册</a> </li>
                @else
                    <li>  <a class="navbar-item" href="#user/{{session('user_id')}}/question">{{ session('username') }}</a> </li>
                    <li>   <a class="navbar-item" href="{{url('api/logout')}}">登出</a> </li>
                @endif
            </ul>

        </div>
    </div>
    {{-- ui-view 指令对应template中的内容 --}}
    <div class="page">
        <div ui-view/>
    </div>
</body>



</html>