/**
 *
 *
 */

angular.module('coding', ['home','user','category','live','keda'])
    .config([
        '$interpolateProvider',
        function ($interpolateProvider){
            $interpolateProvider.startSymbol('[:');
            $interpolateProvider.endSymbol(':]');
        }])


/**
 * 一个全局的CommonController
 */
    .controller('CommonController', [
        '$scope',
        '$http',

        function ($scope, $http ) {

            $scope.changeCode= function () {
                $('#logincode').attr('src','/createCode?random'+Math.random());
            }

            $scope.signUp = function () {
                console.log($scope.signupdata.phone);
                console.log($scope.signupdata.password);
                console.log($scope.signupdata.repassword);
                console.log($scope.signupdata.validatecode);
                $http.post('/register'
                    ,{
                        'phone':$scope.signupdata.phone,
                        'password':$scope.signupdata.password,
                        'code':$scope.signupdata.validatecode
                    })
                    .then(function(r){
                        console.log(r);
                        if(r.data.status == 0) {

                            window.location.reload();
                        }else if(r.data.status != 0){
                            $scope.signuperrors= r.data.msg;
                        }
                    }
                    ,function(e){
                        //fail
                        console.log(e);
                    })
            }



            $scope.login = function () {
                $http.post('/login'
                    ,{
                        'phone':$scope.logindata.phone,
                        'password':$scope.logindata.password,
                        'code':$scope.logindata.code
                    })
                    .then(function(r){
                        console.log(r);
                        if(r.data.status == 0) {
                            window.location.reload();
                        }else if(r.data.status != 0){
                            $scope.changeCode();
                            $scope.loginerrors= r.data.msg;
                        }
                    }
                    ,function(e){

                    })
            }

            $scope.search = function () {

            }
            $scope.getSMSCode = function () {
                console.log('getSMSCode');
                console.log($scope.signupdata.phone);
                $http.post('/sendSMS'
                    ,{'phone':$scope.signupdata.phone})
                    .then(function(r){

                        console.log(r);
                        if(r.data.status == 0) {
                            console.log(1);
                            var num = 60;
                            $('#sms_send').attr('disabled','');
                            var interval = window.setInterval(function() {
                                $('#sms_send').html(--num + 's 重新发送');
                                if(num == 0) {
                                    $('#sms_send').removeAttr('disabled');
                                    window.clearInterval(interval);
                                    $('#sms_send').html('重新发送');
                                }
                            }, 1000);
                        }else{

                        }
                    }
                    ,function(e){
                        //fail
                        console.log(e);
                    })
            }
        }
    ])

