@extends('page.index')

@section('title')
    category
@stop

@section('content')
    <div ng-controller="CategoryController">

<<<<<<< HEAD
        <h2>{{rq('category_title')}}</h2>
=======
        <h2 >{{rq('category_title')}}</h2>
>>>>>>> origin/master

        <div class="col-md-12  category-container">

            @foreach ($lives as $item)

<<<<<<< HEAD
                <a href="{{url('live').'?live_id='.$item->id}}">
                    <div class="col-sm-4 col-md-3">

                        <div class="thumbnail hvr-shadow">
                            <img src="{{ $item->frontcover?:'/img/Koala.jpg' }}" alt="...">

                            <div class="caption">
                                <h3>  {{$item->title}}</h3>

                                <p>   {{ $item->desc }}</p>
                            </div>
=======
                        <div class="caption">
                            <div class="col-md-2 category-avatar" >
                                @if($item->user->avatar_url)
                                    <img src="{{ $user->avatar_url }}" alt="" class="img-circle avatar">
                                @else
                                    <img src="/laravel/coding/public/img/Penguins.jpg" alt="" class="img-circle avatar" style="width: 45px; height: 45px; ">
                                @endif

                            </div>
                            <div class="col-md-10 category-msg" >
                                <h5>
                                <strong class="category-top">
                                    {{$item->title}}

                                    <span class="glyphicon glyphicon-eye-open category-msg-watchnum" aria-hidden="true" ></span>
                                    {{ $item->watchnum }}
                                </strong>
                                </h5>
                                <p class="text-muted category-msg-nickname" >
                                   {{ $item->user->nickname?:'用户'.$item->user->phone }}
                                </p>
                            </div>


                            <div class="clearfix" ></div>
                            {{--<h3>{{$item->title}}</h3>--}}

                            {{--<p>{{$item->desc}}</p>--}}
>>>>>>> origin/master
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
        {{  $lives->appends(['category_id' => rq('category_id'),'category_title'=>rq('category_title')])->links() }}

    </div>
    <div class="clearfix"></div>

@stop
