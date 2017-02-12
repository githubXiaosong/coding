angular.module('live', [])

    .controller('LiveController', [
        '$scope',
        '$http',
        function ($scope, $http) {

            (function () {
                /**
                 * 视频类型播放优先级
                 * mobile ：m3u8>mp4
                 * PC ：RTMP>flv>m3u8>mp4
                 */
                var options = {
                    rtmp: rtmp,
                    flv: flv,
                    flv_hd: flv,
                    flv_sd: flv,
                    m3u8: m3u8 || 'http://2527.vod.myqcloud.com/2527_b3907044441c11e6a46d294f954f93eb.f230.av.m3u8',
                    m3u8_hd: m3u8 || 'http://2527.vod.myqcloud.com/2527_b3907044441c11e6a46d294f954f93eb.f230.av.m3u8',
                    m3u8_sd: m3u8 || 'http://2527.vod.myqcloud.com/2527_b3907044441c11e6a46d294f954f93eb.f230.av.m3u8',
                    coverpic: coverpic,
                    autoplay: autoplay ? true : false,
                    live: live,
                    width: '890',
                    height: '500'
                };
                var player = new TcPlayer('video-container', options);
                window.qcplayer = player;
            })();

            $(window).load(function () {
                $http.post('/laravel/coding/public/enterGroup'
                    , {'live_id': live_id})
                    .then(function (r) {
                        console.log(r);
                    }
                    , function (e) {
                        console.log(e);
                    })
            });

            //监听不到
            //$(function () {
            //    $(window).unload(function () {
            //        $http.post('/laravel/coding/public/quitGroup'
            //            , {'live_id': live_id})
            //            .then(function (r) {
            //                console.log(r);
            //            }
            //            , function (e) {
            //                console.log(e);
            //            })
            //    });
            //});

            $(window).beforeunload(function(event){
                $http.post('/laravel/coding/public/quitGroup'
                    , {'live_id': live_id})
                    .then(function (r) {
                        console.log(r);
                    }
                    , function (e) {
                        console.log(e);
                    })
            });



        }
    ])