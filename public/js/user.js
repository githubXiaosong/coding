angular.module('user',[])

    .controller('UserController', [
        '$scope',
        '$http',
        function ($scope,$http) {
            /**
             * 把用户的信息挂到scope中去
             */

        }
    ])

    .controller('UserDataController',[
        '$scope',
        '$http',
        function ($scope,$http){

        }
    ])

    .controller('UserLiveController',[
        '$scope',
        '$http',
        function ($scope,$http){

            /**
             * 补充三个按钮的逻辑
             */
            $(".tab-group button").click(function (a) {
                $(".tab-group button").removeClass('active');
                $(this).addClass('active');
            });

            $scope.changeTitle= function () {
                console.log(1);
            }

            $scope.changeDesc= function () {
                console.log(1);
            }

            $scope.changeCategory= function () {
                console.log(1);
            }

            $scope.createLive= function () {
                console.log($scope.createLiveData.category);
                console.log($scope.createLiveData.title);
                console.log($scope.createLiveData.desc);
                console.log($scope.createLiveData.accept);
                $http.post('/laravel/coding/public/createLive'
                    ,{
                        'title':$scope.createLiveData.title,
                        'desc':$scope.createLiveData.desc,
                        'category':$scope.createLiveData.category,
                        'accept':$scope.createLiveData.accept
                    })
                    .then(function(r){
                        console.log(r);
                        if(r.data.status == 0) {
                            alert('创建成功! 请在推流软件中输入rtmp地址并开始推流');
                            window.location.reload();
                        }else if(r.data.status != 0){
                            $scope.createLiveErrors= r.data.msg;
                        }
                    }
                    ,function(e){

                    })
            };

        }
    ])

    .controller('UserLikeController',[
        '$scope',
        '$http',
        function ($scope,$http){

        }
    ])

    .controller('UserQuestionController',[
        '$scope',
        '$http',
        function ($scope,$http){

        }
    ])