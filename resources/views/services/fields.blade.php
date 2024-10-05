<div class="row">
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('name', __('messages.common.name').':', ['class' => 'form-label required']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('messages.common.name')  , 'required']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('category_id',__('messages.service.category').':', ['class' => 'form-label required']) }}
            <div class="input-group flex-nowrap">
                {{ Form::select('category_id',$data['serviceCategories'], null,['class' => 'form-select io-select2',
            'placeholder' => __('messages.service.category'),'data-control'=>'select2','id'=>'serviceCategory']) }}
                <div class="input-group-append" id="createServiceCategory">
                <div class="input-group-text">
                    <a href="javascript:void(0)" data-toggle="modal" id="createServiceCategoryButtonID"
                       data-target="#createServiceCategoryModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6">
    <div class="mb-5">
            {{ Form::label('charges', __('messages.service.charges').':', ['class' => 'form-label required']) }}
            <div class="input-group">
                {{ Form::text('charges', null, ['class' => 'form-control price-input', 'placeholder' => __('messages.service.charges'),'step'=>'any','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
                <div class="input-group-text">
                    <a class="fw-bolder text-gray-500 text-decoration-none">{{ getCurrencyIcon() }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('doctors', __('messages.doctors').':', ['class' => 'form-label required']) }}
        {{ Form::select('doctors[]',$data['doctors'],(isset($selectedDoctor)) ? $selectedDoctor : null,['class' => 'form-control io-select2', 'data-placeholder' => __('messages.doctor.select_doctors'), 'data-control'=>'select2','multiple']) }}
    </div>
    <div class="col-lg-12">
        <div class="mb-5">
            {{ Form::label('short_description', __('messages.service.short_description').':', ['class' => 'form-label required']) }}
            <span data-bs-toggle="tooltip"
                  data-placement="top"
                  data-bs-original-title="{{ __('messages.flash.maximum_char') }}">
                                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                        </span>
            {{ Form::textarea('short_description', null, ['class' => 'form-control', 'placeholder' => __('messages.service.short_description'), 'rows'=> 5,'maxlength'=> 60]) }}
        </div>
    </div>

    <div class="col-lg-6 mb-7">
        <div class="mb-3" io-image-input="true">
            <label for="exampleInputImage" class="form-label required">{{__('messages.front_service.icon')}}:</label>
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage" id="exampleInputImage" style="background-image: url({{ !empty($service->icon) ? $service->icon : asset('web/media/avatars/male.png') }})">
                    </div>
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                          data-placement="top" data-bs-original-title="{{ __('messages.common.change_image') }}">
                        <label>
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                            <input type="file" id="profile_image" name="icon" class="image-upload d-none icon-validation" accept="image/*" />
                        </label>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-5 col-lg-6">
        {{ Form::label('status', __('messages.doctor.status').':', ['class' => 'form-label']) }}
        @if(!empty($service))
            <div class="col-lg-8">
                <div class="form-check form-switch">
                    <input type="checkbox" name="status" value="1" class="form-check-input"
                           id="allowmarketing" {{ $service->status == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="allowmarketing"></label>
                </div>
            </div>
        @else
            <div class="col-lg-8">
                <div class="form-check form-switch">
                    <input type="checkbox" name="status" value="1" class="form-check-input"
                           id="allowmarketing" checked>
                    <label class="form-check-label" for="allowmarketing"></label>
                </div>
            </div>
        @endif
    </div>
    <div>
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
        <a href="{{route('services.index')}}" type="reset"
           class="btn btn-secondary">{{__('messages.common.discard')}}</a>
    </div>
</div>
