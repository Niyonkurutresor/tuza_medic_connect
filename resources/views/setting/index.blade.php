@extends('layouts.app')
@section('title')
    {{__('messages.settings')}}
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid">
        <div class="container">
            @include('setting.setting_menu')
        </div>
    </div>
@endsection
