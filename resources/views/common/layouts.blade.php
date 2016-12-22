<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>轻松学会Laravel - @yield('title')</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    @section('style')

    @show
</head>

<body>
<!--代码-->
@section('header')
<div class="navbar navbar-default" role="navigation">
    <ul class="nav navbar-nav">
        <li class="active"><a href="##">网站首页</a></li>
        <li><a href="##">系列教程</a></li>
        <li><a href="##">名师介绍</a></li>
        <li><a href="##">成功案例</a></li>
        <li><a href="##">关于我们</a></li>
    </ul>
</div>
@show


<div class="container">
    <div class="row">
        <div class="col-md-3">
            @section('listmenu')
            <div class="list-group">
                <a href="{{ url('index') }}" class="list-group-item {{ Request::getPathInfo()=='/index'? 'active' : '' }}">学生列表</a>
                <a href="{{ url('create') }}" class="list-group-item {{ Request::getPathInfo()=='/create'? 'active' : '' }}">新增学生</a>
            </div>
            @show
        </div>
        <div class="col-md-8" >

            @include('common.message')

            @include('common.errors')

            @yield('content')



        </div>
    </div>
</div>

@section('footer')
<div class="navbar navbar-default navbar-bottom" style="background-color: gray; height: 100px;text-align:center;  opacity: 0.6 ;margin: 0px ;padding: 5%  " >
    <p >imooc.com</p>

</div>
@show

<!--代码-->
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
@section('javascript')

@show
</body>
</html>