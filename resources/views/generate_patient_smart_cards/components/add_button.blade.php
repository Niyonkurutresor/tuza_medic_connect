{{-- @if (!isRole('patient')) --}}
<a href="javascript:void(0)" class="btn btn-primary add-templates" data-toggle="modal"
    data-target="#add_templates_modal">{{__('messages.smart_patient_card.generate_patient_card')}}</a>
{{-- @endif --}}
