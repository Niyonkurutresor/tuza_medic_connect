<div class="col-12">
    <div class="d-flex justify-content-between align-items-end mb-5">
        <h1>{{$title}}</h1>
        <a class="btn btn-outline-primary float-end"
           href="{{$back}}">{{ __('messages.common.back') }}</a>
    </div>
    <div class="col-12">
        @include('layouts.errors')
    </div>
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => [$route, $recordID], 'method' => $method, 'files' => $files,'id'=>$id]) !!}
            @include($fields)
            {{ Form::close() }}
        </div>
    </div>
</div>
