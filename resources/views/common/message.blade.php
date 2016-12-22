<div class="alter">
    @if( Session::has('succeed') )
    <div class="alert  alert-success" role="alert">{{ Session::get('succeed') }}</div>
    @endif

    @if( Session::has('error') )
    <div class="alert alert-danger" role="alert">
        <ul class="list-unstyled">

            <li>{{Session::get('error')}}</li>

        </ul>
    </div>
    @endif

</div>