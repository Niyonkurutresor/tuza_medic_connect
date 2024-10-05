<div class="d-flex justify-content-end flex-wrap align-items-center">
    <div class="mt-3 ">
        {{ Form::text('holidate', null, ['class' => 'form-control px-3 custom-width form-control-solid', 'placeholder' => __('messages.common.pick_date_range'), 'id' => 'holidayDateFilter', 'required']) }}
    </div>

    <div class="mt-3 ms-3">
        <a type="button" class="btn btn-primary" href="{{ route('doctors.holiday-create') }}">
            {{ __('messages.holiday.add_holiday') }}
        </a>
    </div>
</div>
