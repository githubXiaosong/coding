@extends('page.index')

@section('title')
    category
@stop

@section('content')
    <div ng-controller="CategoryController">

        <h2>{{rq('category_title')}}</h2>

        <div class="col-md-12  category-container">

            @foreach ($lives as $item)

                <a href="{{url('live').'?live_id='.$item->id}}">
                    <div class="col-sm-4 col-md-3">

                        <div class="thumbnail hvr-shadow">
                            <img src="{{ $item->frontcover?:'/img/Koala.jpg' }}" alt="...">

                            <div class="caption">
                                <h3>  {{$item->title}}</h3>

                                <p>   {{ $item->desc }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
        {{  $lives->appends(['category_id' => rq('category_id'),'category_title'=>rq('category_title')])->links() }}

    </div>
    <div class="clearfix"></div>

@stop
