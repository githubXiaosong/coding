angular.module('category',[])

    .controller('CategoryController', [
        '$scope',
        '$http',
        function ($scope,$http) {
            //mouseenter事件只会在绑定它的元素上被调用，而不会在后代节点上被触发
            $(".category-item").mouseenter(function () {
                $(this).find(".play").show(200);
            }).mouseleave(function () {
                $(this).find(".play").hide(200);
            })
        }
    ])

    .controller('CategoryTypeController',[
        '$scope',
        '$http',
        function ($scope,$http){

        }
    ])

    .controller('CategoryTagController',[
        '$scope',
        '$http',
        function ($scope,$http){

        }
    ])




