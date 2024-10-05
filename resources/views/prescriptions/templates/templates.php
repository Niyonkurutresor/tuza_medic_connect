<script class="pageActionTemplate" type="text/x-jsrender">

    <a href="{{:showUrl}}" title="<?php echo __('messages.common.view') ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
<i class="fas fa-eye fs-5"></i>
</a>

    <a href="{{:url}}" title="<?php echo __('messages.common.edit') ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
        <span class="svg-icon svg-icon-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
            </svg>
        </span>
    </a>

    <a href="#" title="<?php echo __('messages.common.delete') ?>" data-id={{:id}}" class="delete-btn btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
        <span class="svg-icon svg-icon-3">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24" />
        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" /></g></svg></span>
    </a>


</script>


<script id="prescriptionStatusTemplate" type="text/x-jsrender">
    <label class="form-check form-switch form-check-custom form-check-solid form-switch-sm">
         <input name="status" data-id="{{:id}}" class="form-check-input status" type="checkbox" value="1" {{:checked}} >
          <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
    </label>


</script>

<script id="prescriptionActionTemplate" type="text/x-jsrender">

      <a href="#" title="<?php echo __('messages.common.view') ?>" data-id="{{:id}}" class="btn show-btn px-2 text-info fs-3 ps-0 py-2" data-bs-toggle="tooltip">
            <i class="fas fa-eye fs-5"></i>
        </a>
        <a href="{{:url}}" title="<?php echo __('messages.common.edit') ?>" class="btn px-0 text-primary fs-3 py-2">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <a href="#" title="<?php echo __('messages.common.delete') ?>" data-id="{{:id}}" class="btn delete-btn px-2 text-danger ps-2 py-2">
            <i class="fa-solid fa-trash"></i>
        </a>


</script>

<script id="prescriptionMedicineTemplate" type="text/x-jsrender">
    <tr>
        <td class="table__item-desc">
            <select class="form-select prescriptionMedicineId quantityget select2Selector" name="medicine[]" placeholder="<?php echo __('messages.medicine_bills.select_medicine') ?>" data-id="{{:uniqueId}}" required>
                <option>Select Medicine</option>
                {{for medicines}}
                    <option value="{{:key}}">{{:value}}</option>
                {{/for}}
            </select>
        </td>
        <td>
            <input class="form-control prescription-dose" required="" name="dosage[]" type="text" placeholder="<?php echo __('messages.medicine.dosage') ?>">
            <small class=" text-danger avalable-amount"></small>
        </td>
        <td>


            <select class="form-select DoseDurationIdTemplate select2Selector" name="day[]" placeholder="<?php echo __('messages.medicine.dose_interval') ?>" 'data-control' => 'select2' data-id="{{:uniqueId}}" required>
                {{for doseDuration}}
                    <option value="{{:key}}">{{:value}}</option>
                {{/for}}
            </select>

        </td>
        <td>
            <div class="extrm">
                <select class="form-select prescriptionMedicineMealId" name="time[]" data-id="{{:uniqueId}}" 'data-control' => 'select2'>
                    {{for meals}}
                        <option value="{{:key}}">{{:value}}</option>
                    {{/for}}
                </select>
                <div class="d-flex">
                    <small class="text-success totalqty extra-margin d-none" id="totalqty{{:uniqueId}}">Total Quentity :</small>
                    <small class="text-success quantityshow" id="quantityshow{{:uniqueId}}"></small>
                </div>
            </div>

        </td>
        <td>

        <select class="form-select DoseInterValIdTemplate" name="dose_interval[]" data-id="{{:uniqueId}}">
                {{for doseInterVal}}
                    <option value="{{:key}}">{{:value}}</option>
                {{/for}}
            </select>
        <td>
            <textarea class="form-control" name="comment[]" type="text" rows="1" placeholder="<?php echo __('messages.prescription.comment') ?>"></textarea>
        </td>
        <td class="text-center">
            <a href="javascript:void(0)" title="<?php echo __('messages.common.delete') ?>"
               class="delete-prescription-medicine-item btn px-1 text-danger fs-3 pe-0">
                     <i class="fa-solid fa-trash"></i>
            </a>
        </td>
    </tr>
    <!-- <td>
    <div class="d-flex">
            <span class="float-left text-success totalqty d-none">Total Quentity :</span>
            <span class="text-success quantityshow" id="quantityshow{{:uniqueId}}"></span>
        </div>
    </td> -->

</script>
