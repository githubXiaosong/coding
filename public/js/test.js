/**
 *
 * Created by Administrator on 2016/12/27.
 */

angular.module('test',[])
    .controller('TestController',[
        '$scope',
        '$http',
        function($scope,$http)
        {

            $.ajax({
                type: 'POST',
                url: "api/contentType",
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify({
                    'age':20
                }),
                dataType: "json",
                success: function (message) {
                    console.log(message);
                },
                error: function (message) {
                    $("#request-process-patent").html("提交数据失败！");
                }
            });
        }
    ])
