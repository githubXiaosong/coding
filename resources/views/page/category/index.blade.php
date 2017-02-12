@extends('page.index')

@section('title')
    category
@stop

@section('content')
    <div class="text-center" ng-controller="CategoryController">
        <h2>{{rq('category_title')}}</h2>

        <div class="col-md-12  category-container">

            @foreach ($lives as $item)
                <a class="col-md-3 category-item "  href="{{url('live').'?live_id='.$item->id}}">
                    <div class="thumbnail ">
                        <img src="{{ $item->frontcover?:'/laravel/coding/public/img/Koala.jpg' }}"
                             class="img-rounded  category-item-img" alt="...">

                        <div class="caption">
                            <h3>{{$item->title}}</h3>

                            <p>{{$item->desc}}</p>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
        {{  $lives->appends(['category_id' => rq('category_id'),'category_title'=>rq('category_title')])->links() }}

    </div>
    <div class="clearfix"></div>

@stop
