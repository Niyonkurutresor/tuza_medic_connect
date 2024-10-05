{{ Form::hidden('medicine_bill', isset($medicineBill) ? $medicineBill->id : null, ['id' => 'medicineBillId']) }}

{{ Form::hidden('medicine_bill_status', isset($medicineBill) ? $medicineBill->payment_status : null, ['id' => 'medicineBillStatus']) }}

<div class="row">
    <div class="row">
        <div class="form-group col-md-3 mb-5">
            {{ Form::label('patient_id', __('messages.appointment.patient') . ':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::select('patient_id', $patients, isset($medicineBill) ? $medicineBill->patient_id : null, ['class' => 'form-select', 'required', 'id' => 'prescriptionPatientId', 'placeholder' => __('messages.medicine_bills.select_patient')]) }}
        </div>
        @if (isset($medicineBill))
            <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
                {{ Form::label('bill_date', __('messages.medicine_bills.bill_date') . ':', ['class' => 'form-label']) }}
                <span class="required"></span>
                {{ Form::text('bill_date', isset($medicineBill->bill_date) ? $medicineBill->bill_date : $medicineBill->updated_at , ['class' => getLogInUser()->thememode ? 'bg-light form-control edit_medicine_bill_date' : 'bg-white form-control edit_medicine_bill_date', 'id' => 'editBillDate', 'autocomplete' => 'off']) }}
            </div>
        @else
            <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
                {{ Form::label('bill_date', __('messages.medicine_bills.bill_date') . ':', ['class' => 'form-label']) }}
                <span class="required"></span>
                {{ Form::text('bill_date', null, ['class' => getLogInUser()->thememode ? 'bg-light form-control medicine_bill_date' : 'bg-white form-control medicine_bill_date', 'id' => 'medicine_bill_date', 'autocomplete' => 'off']) }}
            </div>
        @endif
        <div class="col-lg-3 col-md-4 col-sm-12">
            <span class="form-label">{{ __('messages.medicine_bills.payment_status') . ' :' }}</span>
            <label class="form-check form-switch form-switch-sm">
                <input type="checkbox" name="payment_status" class="form-check-input mt-5" value="1"
                    {{ !empty($medicineBill->payment_status) == '1' ? 'checked disabled' : '' }}
                    id="medicineBillPaymentStatus">
                <span class="custom-switch-indicator"></span>
            </label>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-sm-12">
        <div class="table-responsive-sm medicinePurchaseCreateTable">
            <div class="overflow-auto">
                <table class="table table-striped" id="prescriptionMedicalTbl">
                    <thead class="thead-dark">
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="">{{ __('messages.medicine_categories') }}<span class="required"></span></th>
                            <th class="">{{ __('messages.medicines') }}<span class="required"></span></th>
                            {{--  <th class="">{{ __('lot no.') }}<span class="required"></span></th>     --}}
                            <th class="">{{ __('messages.purchase_medicine.expiry_date') }}</th>
                            <th class="">{{ __('messages.medicine_bills.sale_price') }}<span class="required"></span></th>
                            {{--  <th class="">{{ __('Purchase Price') }}<span class="required"></span></th>  --}}
                            <th class="">{{ __('messages.medicine.quantity') }}<span class="required"></span></th>
                            <th class="">{{ __('messages.purchase_medicine.tax') }}</th>
                            <th class="">{{ __('messages.purchase_medicine.amount') }}<span class="required"></span></th>
                            @if ( !(isset($medicineBill))||(isset($medicineBill) && $medicineBill->payment_status != 1))
                            <th class="table__add-btn-heading text-center form-label fw-bolder text-gray-700 mb-3">
                                <a href="javascript:void(0)" type="button"
                                    class="btn btn-primary text-star add-medicine-btn-medicine-bill">
                                    {{ __('messages.common.add') }}
                                </a>
                            </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="medicine-bill-container">
                        @if (isset($medicineBill))

                            @foreach ($medicineBill->saleMedicine as $key => $saleMedicine)
                                <tr>
                                    <td>
                                        {{ Form::select('category_id[]', $medicineCategories, isset($saleMedicine->medicine->category->id) ? $saleMedicine->medicine->category->id : null   , ['class' => 'form-select  select2Selector medicineBillCategoriesId', 'required', 'placeholder' => __('messages.common.select_category'), 'data-id' => '1', 'data-control' => 'select2']) }}                                      </td>
                                    <td>
                                        {{ Form::select('medicine[]', $medicines['medicines'], isset($saleMedicine->medicine->id) ? $saleMedicine->medicine->id:null, ['class' => 'form-select medicinePurchaseId purchaseMedicineId', 'placeholder' => __('messages.medicine_bills.select_medicine'), 'data-id' => 1, 'required']) }}                                    </td>
                                    <td>
                                        {{ Form::text('expiry_date[]', null, ['class' => 'form-control medicineBillExpiryDate', 'id' => 'expiry_date1', 'placeholder' => __('messages.purchase_medicine.expiry_date')]) }}
                                    </td>
                                    <td>
                                        {{ Form::text('sale_price[]', number_format($saleMedicine->sale_price,2,'.',''), ['class' => 'form-control medicineBill-sale-price price-format ', 'id' => 'medicine_sale_price' . $key + 1, 'required']) }}
                                    </td>

                                    {{ Form::hidden('quantity1[]', $saleMedicine->sale_quantity, ['class' => 'previous-quantity', 'id' => 'previous-sale-qty' . $key + 1]) }}
                                    <td>
                                        <div class="input-group">
                                        {{ Form::number('quantity[]', $saleMedicine->sale_quantity, ['class' => 'form-control medicineBill-quantity', 'id' => 'quantity' . $key + 1, 'required']) }}
                                        <span class="input-group-text ms-0 medicineTotalQuantity" id="quantityshowside1">{{$saleMedicine->medicine->available_quantity}}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            {{ Form::number('tax_medicine[]', $saleMedicine->tax, ['class' => 'form-control medicineBill-tax','id' => 'tax' . $key + 1]) }}
                                            <span class="input-group-text ms-0" id="amountTypeSymbol">
                                                {{ __('%') }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        {{ Form::text('amount[]', number_format($saleMedicine->sale_quantity * $saleMedicine->sale_price,2,'.',''), ['class' => 'form-control medicine-bill-amount price-format', 'readonly', 'id' => 'amount' . $key + 1]) }}
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" title="{{ __('messages.common.delete') }}"
                                            class="delete-medicine-bill-item btn px-1 text-danger fs-3 pe-0">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                    {{ Form::select('category_id[]', $medicineCategories, null, ['class' => 'form-select medicineBillCategoriesId select2Selector','required','placeholder'=>__('messages.common.select_category'), 'data-id' => 1,'data-control'=>'select2']) }}
                                </td>
                                <td>
                                    {{ Form::select('medicine[]', [], null,['class' => 'form-select medicinePurchaseId purchaseMedicineId','placeholder'=>__('messages.medicine_bills.select_medicine'),'id'=>'c1','data-control'=>'select2','data-id'=>1,'required']) }}
                                </td>
                                {{--  <td>
                        {{ Form::number('lot_no[]', null, ['class' => 'form-control', 'id' => 'lot_no1','required','placeholder'=>'Lot no.']) }}
                    </td>  --}}
                                <td>
                                    {{ Form::text('expiry_date[]', null, ['class' => 'form-control medicineBillExpiryDate', 'id' => 'expiry_date1', 'placeholder' =>  __('messages.purchase_medicine.expiry_date')]) }}
                                </td>
                                <td>
                                    {{ Form::text('sale_price[]', '0.00', ['class' => 'form-control medicineBill-sale-price price-format', 'required', 'id' => 'medicine_sale_price1']) }}
                                </td>
                                {{--  <td>
                        {{ Form::number('purchase_price[]', '0.00', ['class' => 'form-control purchase-price', 'readonly', 'rows'=>1, 'id' => 'purchase_price1','required' ]) }}
                    </td>  --}}
                                <td>
                                    <div class="input-group">
                                        {{ Form::number('quantity[]', 0, ['class' => 'form-control medicineBill-quantity', 'id' => 'quantity1', 'required']) }}
                                        <span class="input-group-text ms-0 medicineTotalQuantity" id="quantityshowside1"></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        {{ Form::number('tax_medicine[]', 0, ['class' => 'form-control medicineBill-tax', 'id' => 'tax1']) }}
                                        <span class="input-group-text ms-0" id="amountTypeSymbol">
                                            {{ __('%') }}</span>
                                    </div>
                                </td>
                                <td>
                                    {{ Form::text('amount[]', '0.00', ['class' => 'form-control medicine-bill-amount price-format', 'readonly', 'id' => 'amount1']) }}
                                </td>
                                <td class="text-center">

                                    <a href="javascript:void(0)" title="{{ __('messages.common.delete') }}"
                                        class="delete-medicine-bill-item btn px-1 text-danger fs-3 pe-0">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="row mt-5 justify-content-between">
                <div class="col-md-6 mb-md-0 mb-5">
                    <label class="fw-bold text-muted py-3">{{ __('messages.currency.note') }}</label>
                    {{ Form::textarea('note', null, ['class' => 'form-control', 'rows' => 2, 'Note','placeholder'=> __('messages.currency.note')]) }}
                </div>
                <div class="col-xl-4 col-md-5">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <label class="fw-bold text-muted py-3 required me-5">{{ __('messages.purchase_medicine.total') }}</label>
                        </div>
                        <div>
                            {{ Form::text('total', isset($medicineBill) ? number_format($medicineBill->total,2,'.','') : '0.00', ['class' => 'form-control required price-format', 'readonly', 'id' => 'total']) }}
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <label class="fw-bold text-muted required py-3 me-5">{{ __('messages.purchase_medicine.discount') }}</label>
                        </div>
                        <div>
                            {{ Form::text('discount', isset($medicineBill) ?  number_format($medicineBill->discount,2,'.','') : '0.00', ['class' => 'form-control medicineBill-discount required price-format', 'id' => 'discountAmount']) }}
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <label class="fw-bold text-muted py-3">{{ __('messages.purchase_medicine.tax_amount') }}</label>
                        </div>
                        <div>
                            <div class="input-group">
                                {{ Form::number('tax', isset($medicineBill) ?  number_format($medicineBill->tax_amount,2,'.','') : '0.00', ['class' => 'form-control', 'id' => 'medicineTotalTaxId', 'readonly', 'value' => '0.00']) }}
                                {{--  <span class="input-group-text ms-0" id="amountTypeSymbol"> {{ __('$') }}</span>  --}}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <label class="fw-bold text-muted required py-3">{{ __('messages.purchase_medicine.net_amount') }}</label>
                        </div>
                        <div>
                            {{ Form::text('net_amount', isset($medicineBill) ? number_format($medicineBill->net_amount,2,'.','') : '0.00', ['class' => 'form-control required price-format', 'id' => 'netAmount', 'readonly']) }}
                        </div>
                    </div>
                    <div class="d-sm-flex d-block justify-content-between mb-3">
                        <div>
                            <label class="fw-bold text-muted required py-3">{{ __('messages.medicine_bills.payment_type') }}</label>
                        </div>
                        <div>
                            {{ Form::select('payment_type', App\Models\PurchaseMedicine::PAYMENT_METHOD, null, ['class' => 'form-select medicine-payment-mode', 'placeholder' => __('messages.medicine_bills.select_payment_type'), 'id' => 'paymentMode', 'required']) }}
                        </div>
                    </div>
                    <div>
                        <label class="fw-bold text-muted py-3">{{ __('messages.purchase_medicine.payment_note') }}</label>
                        {{ Form::textarea('payment_note', null, ['class' => 'form-control', 'placeholder' => __('messages.purchase_medicine.payment_note'), 'rows' => 3]) }}
                    </div>
                    <div class="float-end mt-5">
                        {!! Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2', 'saveBtnPurchaseMedicne']) !!}
                        <a href="{!! route('medicine-bills.index') !!}" class="btn btn-secondary">{!! __('messages.common.cancel') !!}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
