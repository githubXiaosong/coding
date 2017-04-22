<?php
function rq($key = null)
{
    return ($key == null) ? Request::all() : Request::get($key);
}

function suc($data=null){
    $ram=['status'=>0];
    if($data)
    {
        $ram['data']=$data;
        return $ram;
    }
    return $ram;
}
function err($code,$data=null){
    if($data)
        return ['status'=>$code,'data'=>$data];
    return ['status'=>$code];
}

Route::group(['middleware' => ['web']], function () {

    /**
     *   测试API
     */
    Route::any('test', 'CommonController@test');


    /**
     * 回调页面
     */
    Route::any('callback', 'Server\CallBackController@liveCallBack');
    Route::any('checkOnlineStatus', 'Server\CallBackController@checkOnlineStatus');

    /**
     * 返回view页面
     */
    Route::get('/', 'Page\HomeController@index');
    Route::get('live', 'Page\LiveController@index');
    Route::get('category', 'Page\CategoryController@index');
    Route::group(['middleware' => ['checkAuth']], function () {
        Route::get('user/data', 'Page\UserController@data');
        Route::get('user/live', 'Page\UserController@live');
        Route::get('user/like', 'Page\UserController@like');
        Route::get('user/question', 'Page\UserController@question');
    });

    /**
     * 服务  这边的接口都需要添加csrf校验
     */
    Route::get('getCategory', 'Service\CategoryController@getCategory');
    Route::get('createCode', 'Service\ValidateController@createCode');
    Route::get('logout', 'Service\UserController@logout');
    Route::post('sendSMS', 'Service\ValidateController@sendSMS');
    Route::post('register', 'Service\UserController@register');
    Route::post('login', 'Service\UserController@login');
    Route::post('enterGroup', 'Service\LiveController@enterGroup');
    Route::post('quitGroup', 'Service\LiveController@quitGroup');
    Route::group(['middleware' => ['checkAuth']], function () {
        Route::post('createLive', 'Service\LiveController@createLive');
        Route::post('changeTitle', 'Service\LiveController@changeTitle');
        Route::post('haveLive', 'CommonController@haveLive');

    });



    /**
     * 科技大学接口  这里的不分service和page都写在一起了
     */
    Route::group(['prefix' => 'forKeDa'], function () {
        Route::any('lists', 'Page\KeDaController@lists');
        Route::any('add', 'Page\KeDaController@add');
        Route::any('details', 'Page\KeDaController@details');
        Route::any('explain', 'Page\KeDaController@explain');

        Route::any('addPet', 'Service\KeDaController@addPet');
        Route::any('updateStatus', 'Service\KeDaController@updateStatus');
        Route::any('getStatus', 'Service\KeDaController@getStatus');
    });




});
