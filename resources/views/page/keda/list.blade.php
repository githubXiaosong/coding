@extends('page.keda.index')



@section('content_pet')
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>昵称</th>
            <th>年龄</th>
            <th>种类</th>
            <th>状态</th>
        </tr>
        </thead>
        <tbody>

        @foreach($pets as $pet)
        <tr>
            <td>{{ $pet->id }}</td>
            <td>{{ $pet->name }}</td>
            <td>{{ $pet->age }}</td>
            <td>{{ $pet->category }}</td>
            <td>{{ $pet->status==0?'健康':'非健康' }}</td>
        </tr>
        @endforeach

        </tbody>
    </table>

@stop
