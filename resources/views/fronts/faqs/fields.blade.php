<div class="row">
    <div class="col-lg-12">
        <div class="mb-5">
            {{ Form::label('question', __('messages.faq.question').':', ['class' => 'form-label required']) }}
            {{ Form::text('question', null, ['class' => 'form-control', 'placeholder' =>  __('messages.faq.question'), 'required']) }}
        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-5">
            {{ Form::label('answer', __('messages.faq.answer').':', ['class' => 'form-label required']) }}
            {{ Form::textarea('answer', null, ['class' => 'form-control', 'placeholder' => __('messages.faq.answer'), 'required', 'rows'=> 5, 'maxLength' => '1000']) }}
        </div>
    </div>
    <div class="d-flex">
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
        <a href="{{ route('faqs.index') }}" type="reset"
           class="btn btn-secondary">{{__('messages.common.discard')}}</a>
    </div>
</div>

