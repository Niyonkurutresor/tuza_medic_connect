@extends('fronts.layouts.app')
@section('front-title')
    {{ __('messages.privacy_policy') }}
@endsection
@section('front-content')
    <section id="content">
        <div class="content-wrap p-t-100">
            <div class="container p-t-30">
                <div class="mt-100">{!! $privacyPolicy['privacy_policy'] !!}</div>
            </div>
        </div>
    </section>
@endsection

