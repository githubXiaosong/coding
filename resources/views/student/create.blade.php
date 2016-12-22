@extends('common.layouts')

@section('title')
    添加学生
@stop

@section('content')


    {{--form--}}
    <div class="panel panel-default">
        <div class="panel-heading">新增学生</div>
        <div class="panel-body">

            <form role="form" method="post" action="">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputEmail1">姓名:</label>
                    <input type="text" name="Student[name]" value="{{old('Student')['name']}}" class="form-control" id="exampleInputEmail1" placeholder="请输入用户名">
                    <p class="form-control-static text-danger"> {{$errors->first('Student.name')}}</p>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">年龄:</label>
                    <input type="text" class="form-control" name="Student[age]" value="{{old('Student')['age']}}" id="exampleInputPassword1" placeholder="请输入年龄">
                    <p class="form-control-static text-danger"> {{$errors->first('Student.age')}}</p>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" >性别:</label>
                    <div class="radio">
                        <label>
                            <input type="radio"  name="Student[sex]" id="optionsRadios2" value="10">
                            男
                        </label>
                        <label>
                            <input type="radio" id="optionsRadios2" name="Student[sex]" value="20">
                            女
                        </label>

                    </div>
                    <p class="form-control-static text-danger"> {{$errors->first('Student.sex')}}</p>
                </div>

                <button type="submit"  style="float: right" class="btn btn-info">创建</button>
            </form>
        </div>

    </div>
    {{--form--}}


@stop
















<!--    form-->
<!--            <div class="panel panel-default">-->
<!--                <div class="panel-heading">新增学生</div>-->
<!--                <div class="panel-body">-->
<!---->
<!--                    <form role="form">-->
<!--                        <div class="form-group">-->
<!--                            <label for="exampleInputEmail1">姓名:</label>-->
<!--                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="请输入用户名">-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="exampleInputPassword1">年龄:</label>-->
<!--                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="请输入年龄">-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="exampleInputPassword1">性别:</label>-->
<!--                            <div class="radio">-->
<!--                                <label>-->
<!--                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="hate">-->
<!--                                    男-->
<!--                                </label>-->
<!--                                <label>-->
<!--                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="hate">-->
<!--                                    女-->
<!--                                </label>-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                        <button type="submit"  style="float: right" class="btn btn-info">创建</button>-->
<!--                    </form>-->
<!--                </div>-->
<!---->
<!--            </div>-->
<!--    form-->


<!--            index  -->
<!--            <table class="table table-striped">-->
<!--                <thead>-->
<!--                <tr>-->
<!--                    <th>表格标题</th>-->
<!--                    <th>表格标题</th>-->
<!--                    <th>表格标题</th>-->
<!--                    <th>表格标题</th>-->
<!--                    <th>表格标题</th>-->
<!--                </tr>-->
<!--                </thead>-->
<!--                <tbody>-->
<!--                <tr>-->
<!--                    <td>表格单元格</td>-->
<!--                    <td>表格单元格</td>-->
<!--                    <td>表格单元格</td>-->
<!--                    <td>表格单元格</td>-->
<!--                    <td>表格单元格</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>表格单元格</td>-->
<!--                    <td>表格单元格</td>-->
<!--                    <td>表格单元格</td>-->
<!--                    <td>表格单元格</td>-->
<!--                    <td>表格单元格</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>表格单元格</td>-->
<!--                    <td>表格单元格</td>-->
<!--                    <td>表格单元格</td>-->
<!--                    <td>表格单元格</td>-->
<!--                    <td>表格单元格</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>表格单元格</td>-->
<!--                    <td>表格单元格</td>-->
<!--                    <td>表格单元格</td>-->
<!--                    <td>表格单元格</td>-->
<!--                    <td>表格单元格</td>-->
<!--                </tr>-->
<!--                </tbody>-->
<!--            </table>-->
<!--            index  -->


<!--            detail-->

<!--            <div class="panel panel-default">-->
<!--                <div class="panel-heading">学生详情</div>-->
<!--                <div class="panel-body" style="padding: 0px">-->
<!--                    <table class="table table-bordered">-->
<!--                                 <tbody>-->
<!--                                        <tr>-->
<!--                                            <th>表格标题</th>-->
<!--                                            <td>表格单元格</td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <th>表格标题</th>-->
<!--                                            <td>表格单元格</td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <th>表格标题</th>-->
<!--                                            <td>表格单元格</td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <th>表格标题</th>-->
<!--                                            <td>表格单元格</td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <th>表格标题</th>-->
<!--                                            <td>表格单元格</td>-->
<!--                                        </tr>-->
<!---->
<!---->
<!--                                        </tbody>-->
<!--                                    </table>-->
<!--                </div>-->
<!--            </div>-->

<!--            detail-->