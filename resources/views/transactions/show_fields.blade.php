<div class="row">
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.appointment.appointment_unique_id') }}:</label>
        <span class="fs-4 text-gray-800">
            <span class="badge bg-warning">{{$transaction['data']->appointment_id}}</span>
        </span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.transaction.transaction_id') }}:</label>
        <span class="fs-4 text-gray-800">{{$transaction['data']->transaction_id}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.doctor_appointment.amount') }}:</label>
        <span class="fs-4 text-gray-800">{{getCurrencyFormat(getCurrencyCode(),$transaction['data']->amount)}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.appointment.payment_method') }}:</label>
        <span class="fs-4 text-gray-800">{{ !empty($transaction['data']->type) ? \App\Models\Appointment::PAYMENT_METHOD[$transaction['data']->type] : __('messages.common.n/a') }}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.appointment.appointment_at') }}:</label>
        <span class="fs-4 text-gray-800">
            @if(!empty($transaction['data']->appointment))
                <span class="badge bg-info">
                                    {{ \Carbon\Carbon::parse($transaction['data']->appointment->date)->isoFormat('DD MMM YYYY')}} {{$transaction['data']->appointment->from_time}} {{$transaction['data']->appointment->from_time_type}} - {{$transaction['data']->appointment->to_time}} {{$transaction['data']->appointment->to_time_type}}
                                </span>
            @else
                {{ __('messages.common.n/a') }}
            @endif
        </span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.appointment.patient') }}:</label>
        <span class="fs-4 text-gray-800">{{$transaction['data']->user->full_name}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.doctor.doctor') }}:</label>
        <span class="fs-4 text-gray-800">
            @if(!empty($transaction['data']->appointment))
                {{$transaction['data']->appointment->doctor->user->full_name}}
            @else
                {{ __('messages.common.n/a') }}
            @endif
        </span>
    </div>
    @if(!empty($transaction['data']->appointment->status) == \App\Models\Appointment::CANCELLED)
        <div class="col-md-6 d-flex flex-column">
            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.transaction.payment_status') }}:</label>
            <span class="fs-4 text-gray-800">
                <span class="badge bg-success">{{ __('messages.transaction.paid') }}</span>
            </span>
        </div>
    @endif
    @if(!empty($transaction['data']->type) && $transaction['data']->type == \App\Models\Appointment::MANUALLY && $transaction['data']->acceptedPaymentUser)
        <div class="col-md-6 d-flex flex-column">
            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.transaction.payment_accepted_by') }}
                :</label>
            <span class="fs-4 text-gray-800">{{$transaction['data']->acceptedPaymentUser->full_name}}</span>
        </div>
    @endif
</div>
