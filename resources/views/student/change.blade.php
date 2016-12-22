@extends('common.layouts')

@section('title')
    修改
@stop


@section('content')


    <div class="panel panel-default">
        <div class="panel-heading">新增学生</div>
        <div class="panel-body">

            <form role="form" method="post" action="">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputEmail1">姓名:</label>
                    <input type="text" name="Student[name]" value="{{old('Student')['name'] ? old('Student')['name'] :$student->name}}" class="form-control" id="exampleInputEmail1" placeholder="请输入用户名">
                    <p class="form-control-static text-danger"> {{$errors->first('Student.name')}}</p>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">年龄:</label>
                    <input type="text" class="form-control" name="Student[age]" value="{{old('Student')['age'] ? old('Student')['age'] :$student->age}}" id="exampleInputPassword1" placeholder="请输入年龄">
                    <p class="form-control-static text-danger"> {{$errors->first('Student.age')}}</p>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" >性别:</label>
                    <div class="radio">
                        <label>
                            <input type="radio"  name="Student[sex]" {{ isset($student->sex) && $student->sex==10 ? 'checked': '' }} id="optionsRadios2" value="10">
                            男
                        </label>
                        <label>
                            <input type="radio" id="optionsRadios2" {{ isset($student->sex) && $student->sex==20 ? 'checked' : '' }} name="Student[sex]" value="20">
                            女
                        </label>

                    </div>
                    <p class="form-control-static text-danger"> {{$errors->first('Student.sex')}}</p>
                </div>

                <button type="submit"  style="float: right" class="btn btn-info">创建</button>
            </form>
        </div>

    </div>



@stop