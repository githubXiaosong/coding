@extends('common.layouts')

@section('title')
    学生详情
@stop


@section('content')

    <!--            detail-->

    <div class="panel panel-default">
        <div class="panel-heading">学生详情</div>
        <div class="panel-body" style="padding: 0px">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th>id</th>
                    <td>{{$student->id}}</td>
                </tr>
                <tr>
                    <th>name</th>
                    <td>{{$student->name}}</td>
                </tr>
                <tr>
                    <th>age</th>
                    <td>{{$student->age}}</td>
                </tr>
                <tr>
                    <th>sex</th>
                    <td>{{$student->sex($student->sex)}}</td>
                </tr>
                <tr>
                    <th>created_at</th>
                    <td>{{ date('Y-m-d',$student->create_at)}}</td>
                </tr>

                <tr>
                    <th>update_at</th>
                    <td>{{ date('Y-m-d',$student->update_at)}}</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>

    <!--            detail-->

@stop