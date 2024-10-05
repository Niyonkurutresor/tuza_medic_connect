@if (isRole('doctor'))
<a type="button" class="btn btn-primary ms-auto" href="{{ route('doctors.smart-patient-cards.create')}}">
    {{__('messages.smart_patient_card.add_smart_card_templates')}}
</a>
@endif
@if (isRole('clinic_admin'))
<a type="button" class="btn btn-primary ms-auto" href="{{ route('smart-patient-cards.create')}}">
    {{__('messages.smart_patient_card.add_smart_card_templates')}}
</a>
@endif

