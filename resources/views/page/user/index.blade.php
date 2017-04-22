@extends('page.index')

@section('title')
    user
@stop


@section('content')
    <div class="container" ng-controller="UserController">

        <div class="row">
            <div class=" col-md-offset-1 ">
                <div class="col-md-11">
                    <div class="clearfix ">
                        <h1 class="pull-left n-mp-b">个人中心</h1>
                        <a href="{{url('/user/live')}}" ng-if="!have_live">
                         <button  type="button" class="btn btn-primary btn-lg pull-right">申请直播</button>
                        </a>
                    </div>
                    <hr>
                </div>



                <div class="col-md-2">
                    <div class="list-group">
                        <a href="{{url('user/data')}}"
                           class="list-group-item {{ \Illuminate\Support\Facades\Request::is('user/data') ? 'active' : '' }}">
                            我的资料
                        </a>
                        <a href="{{url('user/live')}}"
                           class="list-group-item {{ \Illuminate\Support\Facades\Request::is('user/live') ? 'active' : '' }}">
                            我的直播
                        </a>
                        <a href="{{url('user/like')}}"
                           class="list-group-item {{ \Illuminate\Support\Facades\Request::is('user/like') ? 'active' : '' }}">
                            我的关注
                        </a>
                        <a href="{{url('user/question')}}"
                           class="list-group-item {{ \Illuminate\Support\Facades\Request::is('user/question') ? 'active' : '' }}">
                            问题反馈
                        </a>
                    </div>
                </div>

                <div class="col-md-7">@yield('content_user')</div>

            </div>
        </div>
    </div>
@stop
