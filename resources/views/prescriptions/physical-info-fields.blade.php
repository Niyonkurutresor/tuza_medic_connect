<div class="row gx-10 mb-5">
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('high_blood_pressure', __('messages.prescription.high_blood_pressure').(':'), ['class' => 'form-label']) }}
            {{ Form::text('high_blood_pressure', null, ['class' => 'form-control','placeholder' => __('messages.prescription.high_blood_pressure')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('food_allergies', __('messages.prescription.food_allergies').(':'), ['class' => 'form-label']) }}
            {{ Form::text('food_allergies', null, ['class' => 'form-control','placeholder' => __('messages.prescription.food_allergies')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('tendency_bleed', __('messages.prescription.tendency_bleed').(':'), ['class' => 'form-label']) }}
            {{ Form::text('tendency_bleed', null, ['class' => 'form-control','placeholder' => __('messages.prescription.tendency_bleed')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('heart_disease', __('messages.prescription.heart_disease').(':'), ['class' => 'form-label']) }}
            {{ Form::text('heart_disease', null, ['class' => 'form-control','placeholder' => __('messages.prescription.heart_disease')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('diabetic', __('messages.prescription.diabetic').(':'), ['class' => 'form-label']) }}
            {{ Form::text('diabetic', null, ['class' => 'form-control','placeholder' => __('messages.prescription.diabetic')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('medical_history', __('messages.prescription.medical_history').(':'), ['class' => 'form-label']) }}
            {{ Form::text('medical_history', null, ['class' => 'form-control','placeholder' => __('messages.prescription.medical_history')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('female_pregnancy', __('messages.prescription.female_pregnancy').(':'), ['class' => 'form-label']) }}
            {{ Form::text('female_pregnancy', null, ['class' => 'form-control','placeholder' => __('messages.prescription.female_pregnancy')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('breast_feeding', __('messages.prescription.breast_feeding').(':'), ['class' => 'form-label']) }}
            {{ Form::text('breast_feeding', null, ['class' => 'form-control','placeholder' => __('messages.prescription.breast_feeding')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('current_medication', __('messages.prescription.current_medication').(':'), ['class' => 'form-label']) }}
            {{ Form::text('current_medication', null, ['class' => 'form-control','placeholder' => __('messages.prescription.current_medication')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('surgery', __('messages.prescription.surgery').(':'), ['class' => 'form-label']) }}
            {{ Form::text('surgery', null, ['class' => 'form-control','placeholder' => __('messages.prescription.surgery')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('accident', __('messages.prescription.accident').(':'), ['class' => 'form-label']) }}
            {{ Form::text('accident', null, ['class' => 'form-control','placeholder' => __('messages.prescription.accident')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('others', __('messages.prescription.others').(':'), ['class' => 'form-label']) }}
            {{ Form::text('others', null, ['class' => 'form-control','placeholder' => __('messages.prescription.others')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('plus_rate', __('messages.prescription.plus_rate').(':'), ['class' => 'form-label']) }}
            {{ Form::text('plus_rate', null, ['class' => 'form-control','placeholder' => __('messages.prescription.plus_rate')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('temperature', __('messages.prescription.temperature').(':'), ['class' => 'form-label']) }}
            {{ Form::text('temperature', null, ['class' => 'form-control','placeholder' => __('messages.prescription.temperature')]) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group mb-5">
            {{ Form::label('problem_description', __('messages.prescription.problem_description').(':'), ['class' => 'form-label']) }}
            {{ Form::textarea('problem_description', null, ['class' => 'form-control','placeholder' => __('messages.prescription.problem_description'), 'rows' => 5]) }}
        </div>
    </div>
</div>
