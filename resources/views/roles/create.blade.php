@extends('layouts.app')
@section('title')
    {{__('messages.role.add_role')}}
@endsection
@section('header_toolbar')
    <div class="toolbar">
        <div class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1 ms-auto">
                <a class="btn btn-outline-primary float-end"
                   href="{{ route('roles.index') }}">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="post d-flex  mt-lg-15">
        <div class="container-fluid">
            <div class="d-flex  flex-lg-row">
                <div class="flex-lg-row-fluid mb-10 mb-lg-0">
                    <div class="row">
                        <div class="col-12">
                            @include('layouts.errors')
                        </div>
                    </div>
                    {{ Form::hidden('is_edit', $permissions['count'],['id' => 'totalPermissions']) }}
                    {{ Form::hidden('is_edit', false,['id' => 'roleIsEdit']) }}
                    <div class="card">
                        <div class="card-body p-0">
                            {{ Form::open(['route' => 'roles.store']) }}
                            <div class="card-body p-9">
                                @include('roles.fields')
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
