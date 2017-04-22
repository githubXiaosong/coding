angular.module('keda', [])

    .controller('KedaController', [
        '$scope',
        '$http',
        function ($scope, $http) {

        }
    ])

    .controller('KedaListController', [
        '$scope',
        '$http',
        function ($scope, $http) {

        }
    ])

    .controller('KedaAddController', [
        '$scope',
        '$http',
        function ($scope, $http) {
            $scope.isSucceed = 0;
            $scope.errorInfo = null;
            $scope.addPet = function () {
                console.log($scope.petInfo.name);
                console.log($scope.petInfo.age);
                console.log($scope.petInfo.category);
                $http.post('/forKeDa/addPet'
                    , {
                        'name': $scope.petInfo.name,
                        'age': $scope.petInfo.age,
                        'category': $scope.petInfo.category
                    })
                    .then(function (r) {
                        console.log(r);
                        if (r.data.status == 0) {
                            console.log(1111111111111);
                            $scope.isSucceed = 1;
                        } else if (r.data.status != 0) {
                            $scope.isSucceed = 2;
                            $scope.errorInfo = r.data.data;
                        }
                    }
                    , function (e) {

                    })
            };
        }
    ])

    .controller('KedaDetailsController', [
        '$scope',
        '$http',
        function ($scope, $http) {


            //这是一个延时的函数啊 所以不能立即返回数据的!!!!!
            function getData() {
                var tmpdata;
                $http.post('/forKeDa/getStatus')
                    .then(function (r) {
                        if (r.data.status == 0) {

                            var legend_data = [];
                            var series_data = [];
                            var series_data_in = {};
                            var series_data_in_data = [];

                            for (var p in r.data.data) {
                                //给到键
                                legend_data.push(p);
                                series_data_in = {'name': p, 'type': 'line', 'stack': '总量'};

                                for (var _p in r.data.data[p]) {

                                    series_data_in_data.push(r.data.data[p][_p]['weight']);

                                }
                                series_data_in['data'] = series_data_in_data;
                                series_data.push(series_data_in);
                                series_data_in_data = [];
                            }
                            console.log(series_data);

                            var myChart = echarts.init(document.getElementById('main'));
                            option = {

                                tooltip: {
                                    trigger: 'axis'
                                },
                                legend: {
                                    data: legend_data
                                },
                                grid: {
                                    left: '3%',
                                    right: '4%',
                                    bottom: '3%',
                                    containLabel: true
                                },
                                toolbox: {
                                    feature: {
                                        saveAsImage: {}
                                    }
                                },
                                xAxis: {
                                    type: 'category',
                                    boundaryGap: false,
                                    data: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20]
                                },
                                yAxis: {
                                    type: 'value'
                                },


                                series: series_data
                            };


                            myChart.setOption(option);

                        } else if (r.data.status != 0) {

                        }
                    }
                    , function (e) {

                    })
            };

            getData();


        }
    ])

    .controller('KedaExplainController', [
        '$scope',
        '$http',
        function ($scope, $http) {

        }
    ])
