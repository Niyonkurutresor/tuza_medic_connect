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
        <p>Your Appointment Booked SuccessFully on <b>{{ $date }}</b> between <b>{{ $time }}</b>.</p>
        <p>Click the below button to cancel the appointment.</p>
        <div style="display: flex;justify-content: center">
        <a href="{{ route('cancelAppointment',['patient_id'=>$patientId,'appointment_unique_id'=>$appointmentUniqueId]) }}" style="padding: 7px 15px;text-decoration: none;font-size: 14px;background-color: #df4645;font-weight: 500;border: none;border-radius: 8px;color: white">
                Cancel Appointment
        </a>
        </div>
    </div>

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <h6>© {{ date('Y') }} {{ getAppName() }}.</h6>
        @endcomponent
    @endslot
@endcomponent
