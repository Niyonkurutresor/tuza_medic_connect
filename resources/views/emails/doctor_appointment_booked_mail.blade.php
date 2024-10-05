@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{ asset(getAppLogo()) }}" class="logo" alt="{{ getAppName() }}">
        @endcomponent
    @endslot

    {{-- Body --}}
    <div>
        <h2>Hello, <b>{{ $name }}</b></h2>
        <p><b>{{ $patientName }}</b>  Booked appointment with you with service <b>{{$service}}</b>.</p>
        <p><b>Appointment Time : </b>{{ $date }} - {{ $time }}</p>
        <p>Thanks & Regards,</p>
        <p>{{ getAppName() }}</p>
    </div>

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <h6>© {{ date('Y') }} {{ getAppName() }}.</h6>
        @endcomponent
    @endslot
@endcomponent
