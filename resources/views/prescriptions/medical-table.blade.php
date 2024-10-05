@php
    $data = null;
@endphp
{{-- @dd($prescription->medicines[0]->quantity) --}}
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive-sm medicineTable">
            <table class="table table-striped" id="prescriptionMedicalTbl">
                <thead class="thead-dark">
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <th class="">{{ __('messages.medicines') }}<span class="required"></span></th>
                        <th class="">{{ __('messages.medicine.dosage') }}</th>
                        <th class="">{{ __('messages.prescription.duration') }}<span class="required"></span></th>
                        <th class="">{{ __('messages.prescription.time') }}<span class="required"></span></th>
                        <th class="">{{ __('messages.medicine_bills.dose_interval') }}<span
                                class="required"></span></th>
                        <th class="">{{ __('messages.prescription.comment') }}</th>
                        <th class="table__add-btn-heading text-center form-label fw-bolder text-gray-700 mb-3">
                            <a href="javascript:void(0)" type="button"
                                class="btn btn-primary text-star add-medicine-btn" id="addPrescriptionMedicineBtn">
                                {{ __('messages.common.add') }}
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody class="prescription-medicine-container" style="position: relative">
                    @if (isset($prescription))
                        @foreach ($prescription->getMedicine as $key => $prescription)
                            @php
                            if($data == null){
                                $data = ($key+5)*10;
                            }
                            $data = $data +1;
                            $dataID = $data;
                            @endphp
                            <tr>
                                <td>
                                    {{ Form::select('medicine[]', $medicines['medicines'], $prescription->medicine, ['class' => 'form-select prescriptionMedicineId quantityget','data-control' => 'select2', 'data-id' => $dataID]) }}
                                </td>
                                <td>
                                    {{ Form::text('dosage[]', $prescription->dosage, ['class' => 'form-control prescription-dose', 'id' => 'prescriptionMedicineNameId','placeholder' => __('messages.medicine.dosage') ]) }}
                                    <small class="text-danger avalable-amount"></small>
                                </td>
                                <td>
                                    {{ Form::select('day[]', \App\Models\Prescription::DOSE_DURATION, $prescription->day, ['class' => 'form-control prescription-dose', 'data-control' => 'select2']) }}
                                </td>
                                <td>
                                    <div class="extrm mt-5">
                                        {{ Form::select('time[]', \App\Models\Prescription::MEAL_ARR, $prescription->time, ['class' => 'form-select extra-margin-tr prescriptionMedicineMealId' ,'data-control' => 'select2']) }}

                                        <div class="">
                                            <small class="text-success totalqty extra-margin" id=" ">{{ __('messages.prescription.total_quantity') }}</small>
                                            <small class="text-success" id="quantityshow{{$dataID}}">{{$prescription->medicines[0]->available_quantity}}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ Form::select('dose_interval[]', \App\Models\Prescription::DOSE_INTERVAL, $prescription->dose_interval, ['class' => 'form-select prescriptionMedicineMealId','data-control' => 'select2']) }}
                                </td>
                                <td>
                                    {{ Form::textarea('comment[]', $prescription->comment, ['class' => 'form-control','placeholder'=> __('messages.prescription.comment'), 'rows' => 1]) }}
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" title="{{ __('messages.common.delete') }}"
                                        class="delete-prescription-medicine-item btn px-1 text-danger fs-3 pe-0">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>
                                {{ Form::select('medicine[]', $medicines['medicines'], null, ['class' => 'form-select  prescriptionMedicineId quantityget', 'placeholder' => __('messages.prescription.selectMedicine'), 'data-control' => 'select2', 'data-id' => 1]) }}

                            </td>
                            <td>
                                {{ Form::text('dosage[]', null, ['class' => 'form-control prescription-dose', 'id' => 'prescriptionMedicineNameId','placeholder' => __('messages.medicine.dosage')]) }}
                            </td>
                            <td>
                                {{ Form::select('day[]', \App\Models\Prescription::DOSE_DURATION, null, ['class' => 'form-control prescriptionMedicineMealId','data-control' => 'select2']) }}
                            </td>

                            <td>
                                <div class="extrm">
                                    {{ Form::select('time[]', \App\Models\Prescription::MEAL_ARR, null, ['class' => 'form-select extra-margin-tr  prescriptionMedicineMealId','data-control' => 'select2']) }}
                                    <div class="">
                                        <small class="totalqty extra-margin d-none" id="totalqty1">{{ __('messages.prescription.total_quantity') }}:</small>
                                        <small class="text-success" id="quantityshow1"></small>
                                    </div>
                                </div>

                            </td>
                            <td>
                                {{ Form::select('dose_interval[]', \App\Models\Prescription::DOSE_INTERVAL, null, ['class' => 'form-select prescriptionMedicineMealId','data-control' => 'select2']) }}
                            </td>
                            <td>
                                {{ Form::textarea('comment[]', null, ['class' => 'form-control','placeholder'=> __('messages.prescription.comment'), 'rows' => 1]) }}
                            </td>
                            <td class="text-center">
                                <a href="javascript:void(0)" title="{{ __('messages.common.delete') }}"
                                    class="delete-prescription-medicine-item btn px-1 text-danger fs-3 pe-0">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
