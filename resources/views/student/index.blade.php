@extends('common.layouts')

@section('title')
    学生列表
@stop

@section('content')

    <table class="table table-striped">
        <thead>
        <tr>
            <th>姓名</th>
            <th>年龄</th>
            <th>性别</th>
            <th>创建时间</th>
            <th>修改时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($students as $stu)
        <tr>
            <td>{{$stu->name}}</td>
            <td>{{$stu->age}}</td>
            <td>{{$stu->sex($stu->sex)}}</td>
            <td>{{date('Y-m-d',$stu->create_at)}}</td>
            <td>{{date('Y-m-d',$stu->update_at)}}</td>
            <td>
                <a href="{{url('change',['id'=>$stu->id])}}">修改</a>
                <a href="{{url('detail',['id'=>$stu->id])}}">详情</a>
                <a href="{{url('delete',['id'=>$stu->id])}}">删除</a>
            </td>
        </tr>
        @endforeach

        </tbody>

    </table>
    <div style="float: right">
        {{ $students->render() }}
    </div>


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