@extends('page.user.index')



@section('content_user')
    <!-- Nav tabs -->
    <div class="panel panel-default big-panel" ng-controller="UserDataController">
        <div class="panel-body">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#base" role="tab" data-toggle="tab">基本资料</a></li>
                <li role="presentation"><a href="#change_passwd" role="tab" data-toggle="tab">修改密码</a></li>
                <li role="presentation"><a href="#change_pic" role="tab" data-toggle="tab">修改头像</a></li>
                <li role="presentation"><a href="#change_nick" role="tab" data-toggle="tab">修改昵称</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active " id="base">
                    <div class="user-info">
                        <div class="pull-left">
                            @if($user->avatar_url)
                                <img src="{{ $user->avatar_url }}" alt="" class="img-circle avatar">
                            @else
                                <img src="/laravel/coding/public/img/Koala.jpg" alt="" class="img-circle avatar">
                            @endif
                        </div>
                        <div class="user-info-text ">
                            <div>

                                <label>昵称:</label>
                                @if($user->nickname)
                                    {{$user->nickname}}
                                @else
                                    用户{{$user->phone}}
                                @endif
                            </div>

                            <div>
                                <label> 手机号: </label>:{{$user->phone}}
                            </div>
                            <div>
                                <label>Email: </label>:@if($user->email)
                                    {{$user->email}}
                                @else
                                    您没有填写邮箱
                                @endif
                            </div>
                            <div>
                                <label>创建时间: </label> {{ $user->created_at }}
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="change_passwd">change_passwd</div>
                <div role="tabpanel" class="tab-pane" id="change_pic">change_pic</div>
                <div role="tabpanel" class="tab-pane" id="change_nick">change_nick</div>
            </div>
        </div>
    </div>

@stop
