@php($createRoute = isRole('doctor') ? 'doctors.prescriptions.create' : (isRole('patient') ? 'patients.prescriptions.create' : 'prescriptions.create'))
<a href="{{ route($createRoute, $this->appointMentId) }}" class="btn btn-primary">
    {{ __('messages.prescription.new_prescription') }}
</a>
