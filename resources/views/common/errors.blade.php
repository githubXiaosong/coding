@if(count($errors))
    <div class="alert alert-danger" role="alert">
        <ul class="list-unstyled">
            {{--$error 是一个全局的变量 只要有就可以在任何地方访问--}}
            @foreach($errors->all() as $err)
            <li> {{$err}} </li>
            @endforeach
        </ul>
    </div>
@endif