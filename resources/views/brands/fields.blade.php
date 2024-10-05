<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-5">
            {!! Form::label('name', __('messages.medicine.brand').':', ['class' => 'form-label']) !!}
            <span class="required"></span>
            {!! Form::text('name', null, ['id'=>'brandName','class' => 'form-control','placeholder' => __('messages.medicine.brand'),'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {!! Form::label('phone', __('messages.web.phone').':', ['class' => 'form-label']) !!}
            <br>
            {!! Form::tel('phone', $brand->phone ?? null, ['class' => 'form-control', 'placeholder' => __('messages.web.phone'), 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) !!}
            {!! Form::hidden('region_code',null,['id'=>'prefix_code']) !!}
            <span id="valid-msg" class="text-success d-block fw-400 fs-small mt-2 hide">✓ {{ __('messages.valid_number') }}</span>
            <span id="error-msg" class="text-danger d-block fw-400 fs-small mt-2 hide"> {{ __('messages.invalid_number') }}</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {!! Form::label('email', __('messages.user.email').':', ['class' => 'form-label']) !!}
            {!! Form::email('email', null, ['id'=>'brandEmail','class' => 'form-control','placeholder' => __('messages.user.email')]) !!}
        </div>
    </div>
    <div class="d-flex justify-content-end">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2', 'id' => 'brandSave']) }}
        <a href="{!! route('brands.index') !!}"
           class="btn btn-secondary">{!! __('messages.common.cancel') !!}</a>
    </div>
</div>
