<div class="modal show fade" id="qualificationModal" aria-modal="true" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>{{__('messages.doctor.add_qualification')}}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            @php
                $styleCss = 'style'
            @endphp
            <div class="modal-body">
                <div class="alert alert-danger fs-4 text-white d-flex align-items-center d-none" role="alert" id="createCityValidationErrorsBox"> 
                    <i class="fa-solid fa-face-frown me-5"></i> 
                </div>
                {{ Form::open(['id' => 'qualificationForm']) }}
                {{ Form::hidden('id',null,['id' => 'qualificationID']) }}
                    <div class="mb-5">
                        {{ Form::label('Degree', __('messages.doctor.degree').':', ['class' => 'form-label required']) }}
                        {{ Form::text('degree', null, ['class' => 'form-control', 'placeholder' => __('messages.doctor.degree'), 'id'=>'degree']) }}
                    </div>
                    <div class="mb-5">
                        {{ Form::label('university', __('messages.doctor.university').':', ['class' => 'form-label required']) }}
                        {{ Form::text('university', null, ['class' => 'form-control', 'placeholder' =>  __('messages.doctor.university'), 'id'=>'university']) }}
                    </div>
                    <div>
                        {{ Form::label('Degree', __('messages.doctor.year').':', ['class' => 'form-label required']) }}
                        {{ Form::select('year', $years,!empty($qualifications->year) ? $qualifications->year : null, 
        ['class' => 'io-select2 form-select', 'data-control'=>"select2", 'id'=> 'year', 'placeholder' =>  __('messages.doctor.select_year'),'data-dropdown-parent'=>'#qualificationModal']) }}
                    </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'),['class' => 'btn btn-primary m-0','id'=>'qualificationSaveBtn']) }}
                {{ Form::button(__('messages.common.discard'),['class' => 'btn btn-secondary my-0 ms-5 me-0','data-bs-dismiss'=>'modal']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
