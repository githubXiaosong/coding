<!doctype html>
<html lang="zh" ng-app="coding">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    {{--默认是从public目录开始的  /就是跟目录的--}}
    <link rel="stylesheet" href="/lib/normalize/normalize.css">
    <link rel="stylesheet" href="/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/css/base.css">
    <script src="/lib/jquery/jquery.js"></script>
    <script src="/lib/angular/angular.min.js"></script>
    <script src="/lib/bootstrap/bootstrap.min.js"></script>
    <script src="/js/base.js"></script>
    <script src="/js/home.js"></script>
    <script src="/js/user.js"></script>
    <script src="/js/live.js"></script>
    <script src="/js/category.js"></script>
    <script src="/js/keda.js"></script>
</head>

<body >


@section('navbar')
    <nav class="navbar navbar-inverse" role="navigation" ng-controller="CommonController">
        <div class="modal fade" id="loginModel" tabindex="-2" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form class="form-horizontal" role="form" name="loginform" ng-submit="login()">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span
                                        aria-hidden="true">&times;</span><span
                                        class="sr-only">Close</span></button>
                            <h4 class="modal-title" style="margin-right: 50%">登陆</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger" role="alert" ng-if="loginerrors">
                                <ul>
                                    <div ng-repeat="errors in loginerrors">
                                        <li ng-repeat="err in errors">[: err :]</li>
                                        <br>
                                    </div>
                                </ul>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">手机号</label>

                                <div class="col-sm-10">
                                    <div class="col-xs-8">
                                        <input
                                                class="form-control"
                                                ng-model="logindata.phone"
                                                name="phone"
                                                ng-minlength="11"
                                                ng-maxlength="11"
                                                required
                                                ng-pattern="/^[0-9]*$/"
                                                id="inputEmail3"
                                                placeholder="请输入手机号">
                                    </div>

                                                     <span style="color:red"
                                                           ng-show="loginform.phone.$dirty && loginform.phone.$invalid">
                                                      <span ng-show="loginform.phone.$error.pattern || loginform.phone.$error.minlength || loginform.phone.$error.maxlength">手机号格式有误。</span>
                                                      </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">密码</label>

                                <div class="col-sm-10">
                                    <div class="col-xs-8">
                                        <input
                                                type="password"
                                                class="form-control"
                                                ng-model="logindata.password"
                                                id="inputPassword3"
                                                name="password"
                                                ng-minlength="6"
                                                ng-maxlength="16"
                                                required
                                                placeholder="请输入您的密码">
                                    </div>

                                                     <span style="color:red"
                                                           ng-show="loginform.password.$dirty && loginform.password.$invalid">
                                                      <span ng-show="loginform.password.$error.minlength || loginform.password.$error.maxlength">密码长度应在6-16位。</span>
                                                      </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">验证码</label>

                                <div class="col-sm-10">
                                    <div class="col-xs-3">
                                        <input type="text"
                                               class="form-control"
                                               ng-model="logindata.code"
                                               id="inputPassword3"
                                               name="validatecode"
                                               ng-minlength="4"
                                               ng-maxlength="4"
                                               required
                                               placeholder="请输入右侧验证码">
                                    </div>

                                                      <span style="color:red"
                                                            ng-show="loginform.validatecode.$dirty && loginform.validatecode.$invalid">
                                                      <span ng-show="loginform.validatecode.$error.pattern||loginform.validatecode.$error.minlength || loginform.validatecode.$error.maxlength">验证码为四位。</span>

                                                      </span>

                                    <div class="col-xs-3">
                                        <img id="logincode" src="/createCode">
                                        <a id="logincodelink" style="cursor: pointer" ng-click="changeCode()">换一张</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                            </button>
                            <button type="submit" class="btn btn-primary">登录</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="signUpModel" tabindex="-2" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form class="form-horizontal" name="signupform" role="form" ng-submit="signUp()">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span
                                        aria-hidden="true">&times;</span><span
                                        class="sr-only">Close</span></button>
                            <h4 class="modal-title" style="margin-right: 50%">注册</h4>
                        </div>
                        <div class="modal-body">

                            <div class="alert alert-danger" role="alert" ng-if="signuperrors">
                                <ul>
                                    <div ng-repeat="errors in signuperrors">
                                        <li ng-repeat="err in errors">[: err :]</li>
                                        <br>
                                    </div>
                                </ul>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">手机号</label>

                                <div class="col-sm-10">
                                    <div class="col-xs-8">
                                        <input type="text"
                                               ng-model="signupdata.phone"
                                               name="phone"
                                               ng-minlength="11"
                                               ng-maxlength="11"
                                               required
                                               ng-pattern="/^[0-9]*$/"
                                               class="form-control" id="inputEmail3"
                                               placeholder="请输入您的手机号"
                                                >
                                    </div>
                                                    <span class="glyphicon glyphicon-ok"
                                                          style="color: rgb(31, 136, 60);"
                                                          ng-show='!signupform.phone.$invalid'> √</span>
                                                     <span style="color:red"
                                                           ng-show="signupform.phone.$dirty && signupform.phone.$invalid">
                                                      <span ng-show="signupform.phone.$error.pattern || signupform.phone.$error.minlength || signupform.phone.$error.maxlength">手机号格式有误。</span>
                                                      </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">密码</label>

                                <div class="col-sm-10">
                                    <div class="col-xs-8">
                                        <input
                                                type="password"
                                                class="form-control"
                                                id="inputPassword3"
                                                placeholder="请输入您的密码"
                                                ng-model="signupdata.password"
                                                name="password"
                                                ng-minlength="6"
                                                ng-maxlength="16"
                                                required
                                                >
                                    </div>
                                                    <span class="glyphicon glyphicon-ok"
                                                          style="color: rgb(31, 136, 60);"
                                                          ng-show='!signupform.password.$invalid'> √</span>
                                                     <span style="color:red"
                                                           ng-show="signupform.password.$dirty && signupform.password.$invalid">
                                                      <span ng-show="signupform.password.$error.minlength || signupform.password.$error.maxlength">密码长度应在6-16位。</span>
                                                      </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">重复密码</label>

                                <div class="col-sm-10">
                                    <div class="col-xs-8">
                                        <input type="password"
                                               class="form-control"
                                               id="inputPassword3"
                                               placeholder="请再次输入您的密码"
                                               name="repassword"
                                               ng-model="signupdata.repassword"
                                               ng-pattern="signupdata.password"
                                               required
                                                >
                                    </div>
                                                    <span class="glyphicon glyphicon-ok"
                                                          style="color: rgb(31, 136, 60);"
                                                          ng-show='!signupform.repassword.$invalid'> √</span>
                                                     <span style="color:red"
                                                           ng-show="signupform.repassword.$dirty && signupform.repassword.$invalid">
                                                         <span ng-show="signupform.repassword.$error.pattern">密码不一致</span>
                                                      </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">验证码</label>

                                <div class="col-sm-10">
                                    <div class="col-xs-4    ">
                                        <input type="text"
                                               class="form-control"
                                               id="inputPassword3"
                                               placeholder="请输入您的收到的验证码"
                                               ng-model="signupdata.validatecode"
                                               name="validatecode"
                                               ng-minlength="4"
                                               ng-maxlength="4"
                                               ng-pattern="/^[0-9]*$/"
                                               required
                                                >
                                    </div>
                                    <div class="col-xs-4">
                                        <button type="button" class="btn btn-default" id="sms_send"
                                                ng-disabled="signupform.phone.$invalid"
                                                ng-click="getSMSCode()">获取验证码
                                        </button>
                                    </div>
                                                    <span class="glyphicon glyphicon-ok"
                                                          style="color: rgb(31, 136, 60);"
                                                          ng-show='!signupform.validatecode.$invalid'> √</span>
                                                      <span style="color:red"
                                                            ng-show="signupform.validatecode.$dirty && signupform.validatecode.$invalid">
                                                      <span ng-show="signupform.validatecode.$error.pattern||signupform.validatecode.$error.minlength || signupform.validatecode.$error.maxlength">验证码为四位数字。</span>

                                                      </span>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                            </button>
                            <button type="submit" class="btn btn-info">注册</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="container-fluid nav-contain ">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Coding</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="{{ \Illuminate\Support\Facades\Request::is('/') ? 'active' : '' }}"><a
                                href="{{url('/')}}">首页</a></li>
                    <li class="{{ \Illuminate\Support\Facades\Request::is('live') ? 'active' : '' }}"><a
                                href="{{url('live')}}">直播中</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">所有分类 <span class="caret"></span></a>

                        <ul class="dropdown-menu" role="menu">
                            @foreach( json_decode(file_get_contents("http://127.0.0.1/getCategory"),true) as $item)
                                <li>
                                    <a href="{{ url('category').'?category_id='.$item['id'].'&category_title='.$item['title'] }}">
                                        {{ $item['title'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="请输入内容">
                    </div>
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        @if (! \Illuminate\Support\Facades\Session::has('user'))
                            <a href="#" data-toggle="modal" data-target="#loginModel">登录</a>
                        @endif


                    </li>
                    <li>
                        @if (! \Illuminate\Support\Facades\Session::has('user'))
                            <a href="#" data-toggle="modal" data-target="#signUpModel">注册</a>
                        @endif


                    </li>
                    @if ( \Illuminate\Support\Facades\Session::has('user') )
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle"
                               data-toggle="dropdown">{{ \Illuminate\Support\Facades\Session::get('user')->phone }}<span
                                        class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url('user/data')}}">个人中心</a></li>
                                <li><a href="#">我的关注</a></li>
                                <li><a href="{{url('user/live')}}">我的直播</a></li>
                                <li class="divider"></li>
                                <li><a href="/logout">退出登录</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->

    </nav>

    @show
            <!--上结束-->
    <div class=" content">
        @yield('content')
    </div>

@section('end')


    <footer class="footer mt-20" style="">
        <div class="container-fluid">
            <nav><a href="#" target="_blank">关于我们</a> <span class="pipe">|</span> <a href="#" target="_blank">联系我们</a>
                <span class="pipe">|</span> <a href="#" target="_blank">法律声明</a></nav>
            <p>Copyright &copy;2017 xiaosong1234.cn All Rights Reserved. <br>
                <a href="http://www.miitbeian.gov.cn/" target="_blank" rel="nofollow">河北科技大学@小松</a><br>
            </p>
        </div>
    </footer>

    @show
            <!--下开始-->


</body>

<script>
    $.support.transition = false;
</script>
</html>
