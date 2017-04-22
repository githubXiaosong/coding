@extends('page.index')

@section('title')
    live
@stop

@section('content')
    <div class="container" ng-controller="LiveController">
        <div>
            <div class="page-header">
                <img class="col-md-2 img-thumbnail" src="/img/Koala.jpg">

                <div class="col-md-10">
                    <h1>{{ $live->title }}
                        <small>{{ $live->desc }}</small>
                    </h1>

                    <div>
                        <div class="fl">

                            <span class="label label-success">{{ $live->category->title }}</span>


                        </div>
                        <div class="fr">
                            <br>
                            <button class="btn btn-primary" type="button" >
                                <span class="badge">{{ $live->watchnum }}</span> &nbsp;观看
                            </button>
                        </div>
                        <div class="clr"></div>
                    </div>

                </div>
                <div class="clr"></div>
            </div>
        </div>
        <div class="col-md-9">

            <div id="video-container" style="margin: 0px auto;margin-bottom: 20px">
                <div id="danmu">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-pills" role="tablist">
                    <li role="presentation" class="active"><a href="#chatting" aria-controls="chatting" role="tab"
                                                              data-toggle="tab">讨论</a></li>
                    <li role="presentation"><a href="#tape" aria-controls="tape" role="tab" data-toggle="tab">他的视频</a>
                    </li>
                    <li role="presentation"><a href="#user" aria-controls="user" role="tab" data-toggle="tab">关于主播</a>
                    </li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="chatting">asdasd</div>
                    <div role="tabpanel" class="tab-pane" id="tape">asd</div>
                    <div role="tabpanel" class="tab-pane" id="user">{{ $live->user->nickname }}</div>
                </div>

            </div>

        </div>
    </div>

    <script src="/lib/TcPlayer/TcPlayer.js"></script>
    <script src="/lib/im/danmu.js"></script>
    <script src="/lib/im/json2.js"></script>
    <script src="/lib/im/webim.js"></script>
    <script type="text/javascript" src="https://tls.qcloud.com/libs/api.min.js"></script>
    <script>

        //初始化播放器
        var rtmp = '{{ $rtmp }}';
        var flv = '{{ $flv }}';
        var m3u8 = '{{ $m3u8 }}';
        var live = '{{ $islive }}';
        var coverpic = '{{ $coverpic }}';
        var autoplay = '{{ $autoplay }}';
        var live_id = '{{ $live_id }}'

        var options = {
            flv: flv,
            
            m3u8: m3u8,
            coverpic: coverpic,
            autoplay: autoplay ? true : false,
            live: live,
            height: '500',
            wording: {
                1002: '主播不在线 清一会再来看看吧',
                2032: '请求视频失败，请检查网络',
                2048: '请求m3u8文件失败，可能是网络错误或者跨域问题'
            }
        };
        var player = new TcPlayer('video-container', options);


        function danmuInit() {
            $("#danmu").danmu({
                left: 0,
                top: 0,
                height: "85%",
                width: "100%",
                speed: 20000,
                opacity: 1,
                font_size_small: 16,
                font_size_big: 24,
                top_botton_danmu_time: 6000
            });
            $('#danmu').danmu('danmuStart');
        }
        danmuInit();




    </script>

@stop
