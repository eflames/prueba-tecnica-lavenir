@if (count($errors) > 0)
    <div class="alert alert-danger">
        <h4 class="mt-3">¡Lo sentimos!, <small>han ocurrido uno o mas errores.</small></h4>
        <ul class="px-5 mt-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(@$message)
    <div id="messageBar" class="alert alert-success">
        {{$message}}
    </div>
@endif

@if(session()->has('message'))
    <div id="messageBar" class='alert alert-success'>
        {!! session()->pull('message') !!}
    </div>
@endif
@if(session()->has('error'))
    <div class='alert alert-danger'>
        {!! session()->pull('error') !!}
    </div>
@endif
