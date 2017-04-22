@extends('page.index')

@section('title')
    For科技大学
@stop

@section('navbar')
    <nav class="navbar navbar-inverse" role="navigation" ng-controller="CommonController">


        <div class="container-fluid nav-contain ">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="#">PetStatus</a>
            </div>
        </div>
        <!-- /.container-fluid -->

    </nav>
@stop


@section('content')

    <div class="container" ng-controller="KedaController">
        <div class="col-md-3">
            <div class="list-group">

                <a href="{{url('forKeDa/lists')}}" class="list-group-item {{ \Illuminate\Support\Facades\Request::is('forKeDa/lists') ? 'active' : '' }}">宠物列表</a>
                <a href="{{url('forKeDa/add')}}" class="list-group-item {{ \Illuminate\Support\Facades\Request::is('forKeDa/add') ? 'active' : '' }}">添加宠物</a>
                <a href="{{url('forKeDa/details')}}" class="list-group-item {{ \Illuminate\Support\Facades\Request::is('forKeDa/details') ? 'active' : '' }}">图表信息</a>
                <a href="{{url('forKeDa/explain')}}" class="list-group-item {{ \Illuminate\Support\Facades\Request::is('forKeDa/explain') ? 'active' : '' }}">开发者说明</a>
            </div>
        </div>

        <div class="col-md-9">
            @yield('content_pet')
        </div>

    </div>
@stop
