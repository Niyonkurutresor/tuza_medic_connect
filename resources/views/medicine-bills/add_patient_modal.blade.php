<div id="addPatientModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.patient.add') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addPatientForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="patientErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('first_name', __('messages.staff.first_name').':', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('first_name', null, ['class' => 'form-control', 'required', 'id' => 'patientFirstName', 'tabindex' => '1', 'placeholder' => __('messages.staff.first_name')]) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('last_name', __('messages.staff.last_name').':', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('last_name', null, ['class' => 'form-control', 'required', 'tabindex' => '2', 'placeholder' => __('messages.staff.last_name')]) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('email', __('messages.user.email').':', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('email', null, ['class' => 'form-control','required', 'placeholder' => __('messages.user.email')]) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('phone', __('messages.web.phone').':', ['class' => 'form-label']) }}<span
                        class="required"></span><br>
                        {{ Form::tel('phone', null, ['class' => 'form-control phoneNumber', 'id' => 'phoneNumber', 'required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'tabindex' => '5']) }}
                        {{ Form::hidden('prefix_code',null,['class'=>'prefix_code']) }}
                        <span class="text-success valid-msg d-none fw-400 fs-small mt-2">✓ &nbsp; {{__('messages.valid')}}</span>
                        <span class="text-danger error-msg d-none fw-400 fs-small mt-2"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('gender', __('messages.user.gender').':', ['class' => 'form-label']) }}
                        <span
                            class="required"></span> &nbsp;<br>
                        <span class="is-valid">
                            <label class="form-label">{{ __('messages.staff.male') }}</label>&nbsp;&nbsp;
                            {{ Form::radio('gender', '0', true, ['class' => 'form-check-input', 'tabindex' => '6','id'=>'patientMale']) }} &nbsp;
                            <label class="form-label">{{ __('messages.staff.female') }}</label>
                            {{ Form::radio('gender', '1', false, ['class' => 'form-check-input', 'tabindex' => '7','id'=>'patientFemale']) }}
                        </span>
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('status', __('messages.web.status').':', ['class' => 'form-label']) }}
                        <div class="form-check form-switch form-check-custom">
                            <input class="form-check-input w-35px h-20px is-active" name="status" type="checkbox" value="1"
                                tabindex="8" checked>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 mb-5">
                        <div>{{ Form::label('password', __('auth.password') . ':', ['class' => 'form-label']) }}<span
                                class="required"></span></div>
                        <div class="form-group col-12 mb-5 position-relative d-flex align-items-center">
                            <div class="position-relative w-100">
                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('messages.patient.password'), 'autocomplete' => 'off', 'aria-label' => __('auth.password'), 'data-toggle' => 'password', 'minlength' => '6', 'maxlength' => '255', 'tabindex' => '10']) }}
                                <span
                                    class="position-absolute d-flex align-items-center top-0 bottom-0 end-0 me-4 input-icon input-password-hide cursor-pointer text-gray-600">
                                    <i class="bi bi-eye-slash-fill"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-5">
                        <div>
                            {{ Form::label('password_confirmation', __('auth.confirm_password') . ':', ['class' => 'form-label']) }}<span
                                class="required"></span></div>
                        <div class="form-group col-12 mb-5 position-relative d-flex align-items-center">
                            <div class="position-relative w-100">
                                {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => __('messages.user.confirm_password'), 'minlength' => '6', 'maxlength' => '255', 'tabindex' => '11', 'aria-label' => __('auth.confirm_password'), 'data-toggle' => 'password']) }}
                                <span
                                    class="position-absolute d-flex align-items-center top-0 bottom-0 end-0 me-4 input-icon input-password-hide cursor-pointer text-gray-600">
                                    <i class="bi bi-eye-slash-fill"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-0">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary m-0','id'=>'patientBtnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" aria-label="Close" class="btn btn-secondary"
                            data-bs-dismiss="modal">{!! __('messages.common.cancel') !!}
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
