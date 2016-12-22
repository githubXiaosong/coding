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
function quesins()
{
    return new App\Question;
}
function answerins()
{
    return new App\Answer;
}
function commentins()
{
    return new App\Comment;
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

Route::group(['middleware'=>['web']],function(){//不开启web中间件是不能使用session的



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

    Route::any('api/user/changepassword',function(){
        return userins()->change_password();
    });

    Route::any('api/user/resetpasswordsend',function(){
        return userins()->resetPassword_send();
    });

    Route::any('api/user/resetpasswordvalidate',function(){
        return userins()->resetPassword_validate();
    });

    Route::any('api/user/getuserinfo',function(){
        return userins()->get_userInfo();
    });

    Route::any('api/user/exists',function(){
        return userins()->exists();
    });

    Route::any('api/question/add',function(){
        return quesins()->add();
    });

    Route::any('api/question/change',function(){
        return quesins()->change();
    });

    Route::any('api/question/read',function(){
        return quesins()->read();
    });

    Route::any('api/question/remove',function(){
        return quesins()->remove();
    });


    Route::any('api/answer/add',function(){
        return answerins()->add();
    });


    Route::any('api/answer/change',function(){
        return answerins()->change();
    });

    Route::any('api/answer/read',function(){
        return answerins()->read();
    });

    Route::any('api/answer/remove',function(){
        return answerins()->remove();
    });

    Route::any('api/answer/vote',function(){
        return answerins()->vote();
    });

    Route::any('api/comment/add',function(){
        return commentins()->add();
    });

    Route::any('api/comment/remove',function (){
       return commentins()->remove();
    });

    Route::any('api/comment/read',function (){
        return commentins()->read();
    });


    /**
     * 各种返回页面tml的方法
     */
    Route::any('tpl/page/home',function(){
       return view('page.home');
    });

    Route::any('tpl/page/login',function(){
        return view('page.login');
    });

    Route::any('tpl/page/signup',function(){
        return view('page.signup');
    });

    Route::any('tpl/page/question/add',function(){
        return view('page.question.add');
    });

    Route::any('tpl/page/question/details',function(){
        return view('page.question.details');
    });

    Route::any('tpl/page/user',function(){
        return view('page.user.user');
    });

    Route::any('tpl/page/user/question',function(){
        return view('page.user.question');
    });

    Route::any('tpl/page/user/answer',function(){
        return view('page.user.answer');
    });








    /**
     * controller中的各种API
     */
    Route::any('api/timeline','CommonController@timeLine');

    Route::any('api/userdetails','CommonController@userDetails');

    Route::any('api/getuseranswer','CommonController@getUserAnswer');

    Route::any('api/getuserquestion','CommonController@getUserQuestion');

    Route::any('api/getquestiondetails','CommonController@getQuestionDetails');

    Route::any('api/getanswerandquestion','CommonController@getAnswerAndQuestion');

    Route::any('api/getcomments','CommonController@getComments');


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
