@extends('fronts.layouts.app')
@section('front-title')
    {{ __('messages.terms_conditions') }}
@endsection
@section('front-content')
    <section id="content">
        <div class="content-wrap p-t-100">
            <div class="container p-t-30">
                <div class="mt-100">{!! $termConditions['terms_conditions'] !!}</div>
            </div>
        </div>
    </section>
@endsection
