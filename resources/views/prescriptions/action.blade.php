@php
    $medicineBill = App\Models\MedicineBill::whereModelType('App\Models\Prescription')->whereModelId($row->id)->first();
    $showRoute = isRole('doctor') ? 'doctors.prescription.medicine.show' : (isRole('patient') ? 'patients.prescription.medicine.show' :'prescription.medicine.show');
    $editRoute = isRole('doctor') ? 'doctors.prescriptions.edit' : (isRole('patient') ? 'patients.prescriptions.edit' :'prescriptions.edit');
    $pdfRoute = isRole('doctor') ? 'doctors.prescriptions.pdf' : (isRole('patient') ? 'patients.prescriptions.pdf' :'prescriptions.pdf');
@endphp

<div class="d-flex align-items-center">
    <a href="{{route($showRoute,$row->id)}}" title="<?php echo __('messages.common.view') ?>"
       class="btn px-1 text-info fs-3">
        <i class="fas fa-eye"></i>
    </a>

    @if(isset($medicineBill->payment_status) && $medicineBill->payment_status == false)
        <a href="{{ route($editRoute,[$this->appointMentId, $row->id]) }}" title="<?php echo __('messages.common.edit') ?>"
            class="btn px-1 text-primary fs-3 prescriptionsviewbtn">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
    @endif
    <a href="{{ route($pdfRoute,$row->id) }}"
        title="<?php echo __('Print Prescription') ?>"
          class="btn px-1 text-warning fs-3">
           <i class="fa fa-print"></i>
       </a>
    <a href="javascript:void(0)" title="<?php echo __('messages.common.delete') ?>" data-id="{{$row->id}}"
       class="btn delete-prescription-btn px-2 text-danger fs-3">
        <i class="fa-solid fa-trash"></i>
    </a>
</div>
