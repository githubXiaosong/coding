<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/24
 * Time: 23:27
 */
namespace App\Http\Controllers;






use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller{


    public function index()
    {

        $students=Student::where('id','>=',2)->orderBy('id','desc')->paginate(6);

        return view('student.index',[
            'students'=>$students
        ]);

    }

    public function create(Request $request)
    {
        if($request->isMethod('POST')){
            //控制器验证
//            $this->validate($request,[
//                'Student.name'=>'required|min:2|max:20',
//                'Student.age'=>'required|integer',
//                'Student.sex'=>'required|integer',
//            ],[
//                'required'=>':attribute 为必填项',
//                'min'=>':attribute 的长度不符号要求',
//                'max'=>':attribute 的长度不符号要求',
//                'integer'=>':attribute 必须为数字',
//            ],[
//                'Student.name'=>'姓名',
//                'Student.age'=>'年龄',
//                'Student.sex'=>'性别',
//            ]);
            //validate 验证
            $validate = \Validator::make(
                $request->input(),[
                'Student.name'=>'required|min:2|max:20',
                'Student.age'=>'required|integer',
                'Student.sex'=>'required|integer',
            ],[
                'required'=>':attribute 为必填项',
                'min'=>':attribute 的长度不符号要求',
                'max'=>':attribute 的长度不符号要求',
                'integer'=>':attribute 必须为数字',
            ],[
                'Student.name'=>'姓名',
                'Student.age'=>'年龄',
                'Student.sex'=>'性别',
            ]);
            if($validate->fails()){
                return redirect()->back()->withErrors($validate)->withInput();
            }


            $data=$request->input('Student');
            if(Student::create($data)){
                return redirect('index')->with('succeed','添加数据成功');
            }else{
                return redirect()->back()->with('error','添加数据失败 ');
            }

        }


        return view('student.create');
    }



    public function createhander(Request $request)
    {
        $data=$request->input('Student');
        $stu=new Student();
        $stu->name=$data['name'];
        $stu->age=$data['age'];
        $stu->sex=$data['sex'];
        if($stu->save()) {
            return redirect('index');
        }else{

            return redirect()->back();
        }
//        var_dump($stu);
    }


    public function detail($id)
    {



        if($student=Student::find($id)) {

            return view('student.detail', [
                'student' => $student
            ]);
        }else{
            return redirect()->back();
        }
    }

    public function change(Request $requset,$id)
    {

        if($requset->isMethod('POST')){
            if($stu=Student::find($id)){
                $data=$requset->input('Student');
                $stu->name=$data['name'];
                $stu->age=$data['age'];
                $stu->sex=$data['sex'];
                if($stu->save()){
                    return redirect('index')->with('succeed','修改成功!');
                }else{
                    return redirect()->back()->with('error','修改失败');
                }
            }
            return redirect()->back()->with('error','修改失败');

        }

        if($stu=Student::find($id)){
            return view('student.change', [
                'student' => $stu
            ]);
        }else{
            return redirect()->back();
        }
    }

    public function delete(Request $requset,$id)
    {
        if($requset->isMethod('GET')){
            if($stu=Student::find($id)){
                if($stu->delete()){
                    return redirect('index')->with('succeed','删除成功');
                }
            }
            return redirect('index')->with('error','删除失败');
        }

        return redirect()->back();
    }

    public function test1()
    {
//dd(array[]) 展示数组
//         $students=DB::select('select * from students where id >?',
//             [1]);//zhi
//        dd($students);
//        $bool=DB::insert('insert into students(name,age) values(?,?)',
//            ['xiaosong1',11]);
//        var_dump($bool);
//        $bool=DB::update('update students set age=? where id=?',
//            [20,1]);
//        var_dump($bool);
//        DB::delete('delete from students where id = ?',['2']);
    }



    public function query1()
    {
//        $bool=DB::table('students')->insert(
//            ['name'=>'imooc', 'age'=>18 ]);
//        var_dump($bool);

//        $id=DB::table('students')->insertGetId(
//            ['name'=>'xiasong2','age'=>17 ]
//        );
//        var_dump($id);
//
//        $bool=DB::table('students')->insert([
//            ['name'=>'xiaosng3','age'=>12],
//            ['name'=>'xiaosng4','age'=>14]
//        ]);
//        var_dump($bool);
    }

    public function query2()
    {
//        $bool=DB::table('students')
//            ->where('id',7)
//            ->update(['age'=>1]);

//          $bool=DB::table('students')->where('id',7)->increment('age');
//        $bool=DB::table('students')->where('id',7)->increment('age',2);
//        $bool=DB::table('students')->where('id',7)->decrement('age');
//        $bool=DB::table('students')->where('id',7)->decrement('age',2);
//        $bool=DB::table('students')->where('id',7)->decrement('age',2,['name'=>'xiaoosng11111']);
//        var_dump($bool);
    }


    public function query3()
    {
//        $num=DB::table('students')
//            ->where('id',7)
//            ->delete();

//        $num=DB::table('students')
//            ->where('id','>=',5)
//            ->delete();
//        var_dump($num);
    }

    public function query4()
    {
        //get   得到符合条件的所有
        //first 得到开头或者结尾的一条
//        $num=DB::table('students')->get();
//        $num=DB::table('students')
//            ->orderBy('id','desc')
//            ->first();
//        $num=DB::table('students')
//            ->where('id','>=',2)
//            ->get();
//        $num=DB::table('students')
//            ->whereRaw('id>=? and age>?',[2,16])
//            ->get();

//        pluck 得到某个字段的数字形式
//        $num=DB::table('students')
//            ->pluck('name');
        //lists 得到某个字段的数字形式 指定索引是那个
//        $num=DB::table('students')
//            ->lists('name','id');
        //select 和where同级用来限制输出那几列 where决定输出那几条
//        $num=DB::table('students')
//            ->select('name','id','name')
//            ->get();
        //chunk 指定几个为一组的潮汛
//        $num=DB::table('students')
//            ->chunk(1000,function($students){
//                dd($students);
//                //查询完一组执行一次 若执行中途退出则会停止查询
//            });
//        var_dump($num);
    }


    public function query5()
    {
        //条数
//        $num=DB::table('students')->conut();
        //不是得到最大的  而是得到最大值  min avg min sum
//        $num=DB::table('students')->max('age');
    }

    public function orm1()
    {
//        $students=Student::all();
        //根据主键进行查询
//        $student=Student::find(4);
        //根据主键进行查询 没查到就报异常
//        Student::findOrFail();
//        $student=Student::get();
//        $student=Student::where('id','>=',3)
//            ->orderBy('age')
//            ->first();

//        Student::chunk(2,function($student){
//           dd($student);
//        });

//        dd(Student::count());

    }


    public function orm2()
    {
//        $student=new Student();
//        $student->name='sean';
//        $student->age=18;
//        $bool=$student->save();
//        dd($bool);

//        $student=Student::find(8);

        //用Create方法新增数据
//        $student=Student::create(
//                ['name'=>'imooc','age'=>10]
//        );

        //用属性查找用户 没有就新增然后取得
//        $student=Student::firstOrCreate([
//            'name'=>'imooc'
//        ]);

        //用属性查找用户 没有就新增一个对象但是不保存 要保存用save 然后取得
//        $student=Student::firstOrNew([
//            'name'=>'xiaosong1234'
//        ]);
//        $student->save();
        echo 'aasdadad';
//        dd($student);
    }

    public function orm3()
    {
//        $student=Student::find(9);
//        $student->name='imoocNew';
//        var_dump($student);
//        $student->save();

//        Student::where('id','>=',8)->update(
//            ['age'=>41]
//        );
    }


    public function orm4()
    {
//        $student=Student::find(1);
//        $student->delete();

//        Student::destroy(3);
//        Student::destroy(3,4,5);
//        Student::where('id','>=',4)->delete();
    }

    public function request1(Request $request)
    {
        //取值
//        echo $request->input('name');
//        echo $request->input('sex','未知');
//        if($request->has('sex')){
//            echo $request->input('sex');
//        }else{
//            echo '不知道';
//        }
//        dd( $request->all());

        //判断请求类型
//        echo $request->method();
//        var_dump( $request->isMethod('POST'));

//        $request->ajax();

        //判断是不是student控制器下的某个方法
//        $request->is('student/*');

        //获取当前的URL
//        $request->url();
    }


    //facade    正面 表面
    //domain    领域 产业 地产
    //php.ini   是PHP的配置文件类似 extension=php_openssl.dl 前面有分号就是屏蔽掉了
    //dd        是一种调试的手段 只要dd()之后就程序就断了

    public function session1(Request $request)
    {
        //1 HTTP requset session();
//        $request->session()->put('key1','value1');

        //2 session()
//        session()->put('key2','value2');

        //3 Session
            //一次存放多个数据到session
//        Session::put(['key4'=>'value4']);
            //数组形式存放Session
//        Session::push('student','xiaosong1');
//        Session::push('student','xiaosong2');

        //暂存  只能够访问一次 第二次了就会删除
//        Session::flash('key5','xiaosong5');


    }

    public function session2(Request $request)
    {

//        var_dump( $request->session()->get('key3') );
//        var_dump( session()->get('key3') );
//        var_dump( Session::get('key3') );
//        var_dump(Session::get('student','default'));
        //pull 取出一次用一次就删除掉
//        $res=Session::pull('key1','default');
//        var_dump($res);
        //取出所有的值
//        dd(Session::all());
        //是否存在
//        var_dump(Session::has('key2'));
        //删除
//        Session::forget('key2');

        //清空session
//        Session::flush();

//        var_dump(Session::get('message'));
    }

    public function response()
    {
        //1响应json
//        $data=[
//            'errCode'=>0,
//            'errMsg'=>'succeed',
//            'data'=>'xiaosong'
//        ];
//        var_dump($data);

        //response()方法封装了 逻辑页面接收和发送json数据 的方法
//        return response()->json($data);

        //2重定向
            //1return redirect('session2')->with('message','我是快闪数据');

            //2action()
//        return redirect()->action('StudentController@session2')->with('message','我是快闪数据');
            //3Route 别名跳转

            //4返回上一个页面
//          return redirect()->back();

    }


//    public function activity0()
//    {
//
//        return '活动快要开始了';
//    }
//
//
//
//    public function activity1()
//    {
//        return '活动进行中';
//    }



}