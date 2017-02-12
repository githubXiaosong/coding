@extends('page.index')

@section('title')
    live
@stop

@section('content')
    <div class="container" ng-controller="LiveController">
        <div class="col-md-8 ">
            <div id="video-container" style="margin: 0px auto;"></div>
        </div>
    </div>

    <script src="/laravel/coding/public/lib/TcPlayer/TcPlayer.js"></script>
    <script>
        var rtmp = '{{ $rtmp }}';
        var flv ='{{ $flv }}';
        var m3u8 ='{{ $m3u8 }}';
        var live ='{{ $live }}';
        var coverpic ='{{ $coverpic }}';
        var autoplay ='{{ $autoplay }}';
        var live_id = '{{ $live_id }}'


    </script>

@stop
