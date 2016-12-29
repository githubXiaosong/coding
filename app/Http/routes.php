 <?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*通用方法*/
function userins()
{
    return new App\User;
}
function roomins()
{
    return new App\Room;
}
function categoryins()
{
    return new App\Category;
}


 function callbackins()
 {
    return new App\Callback\Callback;
 }

function get_limit_and_skip($limit = null)//是不穿为空 而不是穿了null为空
{
    $limit=$limit?:15;
    return ['limit' => $limit, 'skip' => (rq('page') ? (rq('page') - 1) : 0) * $limit];
}



function rq($key=null)
{
    return ($key==null) ? Request::all() : Request::get($key);
}

function suc($data=null){

    $ram=['status'=>1];

    if($data)
    {
         $ram['data']=$data;

        return $ram;
    }
    return $ram;
}

function err($msg='error',$data=null){
    if($data)
        return array_merge(['status'=>2,'msg'=>$msg],$data);
    return ['status'=>0,'msg'=>$msg];
}

function isLogin()
{
    return userins()->is_login();
}




//------------------------------------
Route::group(['middleware'=>['web']],function(){//不开启web中间件是不能使用session的 但是开启之后不能接受非表单的POST请求



    Route::get('/', function ()
    {
        return view('index');
    });


    /**
     * 各种model中的方法
     */
    Route::any('api/user',function(){
        return userins()->signup();
    });

    Route::any('api/login',function(){
        return userins()->login();
    });

    Route::any('api/logout',function(){
        return userins()->logout();
    });












    /**
     * Controller中的各种API
     */
    Route::any('api/timeline','CommonController@timeLine');


    /**
     * 对客户端接口
     */

    Route::any('api/interface/RequestLVBAddr',function(){
        return (new \App\Inter\RequestLVBAddr)->process();
    });

    Route::any('api/interface/FetchList',function(){
        return (new \App\Inter\FetchList)->process();
    });

    Route::any('api/interface/ChangeStatus',function(){
        return (new \App\Inter\ChangeStatus)->process();
    });


    /**
     * callback
     */
    Route::any('api/callback',function(){
        return callbackins()->tencentCallback();
    });




    /**
     *   测试API
     */
    Route::any('tpl/test/test',function(){
        return view('test.test');
    });


});



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
