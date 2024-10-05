<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive-sm medicinePurchaseCreateTable">
            <div class="overflow-auto">
            <table class="table table-striped" id="prescriptionMedicalTbl">
                <thead class="thead-dark">
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th class="">{{ __('messages.medicines') }}<span class="required"></span></th>
                    <th class="">{{ __('messages.purchase_medicine.lot_no') }}<span class="required"></span></th>
                    <th class="">{{ __('messages.purchase_medicine.expiry_date') }}</th>
                    <th class="">{{ __('messages.medicine_bills.sale_price') }}<span class="required"></span></th>
                    <th class="">{{ __('messages.common.purchase_price') }}<span class="required"></span></th>
                    <th class="">{{ __('messages.medicine.quantity') }}<span class="required"></span></th>
                    <th class="">{{ __('messages.purchase_medicine.tax') }}</th>
                    <th class="">{{ __('messages.purchase_medicine.amount') }}<span class="required"></span></th>
                    <th class="table__add-btn-heading text-center form-label fw-bolder text-gray-700 mb-3">
                        <a href="javascript:void(0)" type="button"
                           class="btn btn-primary text-star add-medicine-btn-purchase">
                            {{ __('messages.common.add') }}
                        </a>
                    </th>
                </tr>
                </thead>
                <tbody class="prescription-medicine-container">
                <tr>
                    <td>
                        {{ Form::select('medicine[]', $medicines['medicines'], null,['class' => 'form-select purchaseMedicineId','placeholder'=>__('messages.medicine_bills.select_medicine'),'id'=>'medicineChooseId1','data-control'=>'select2','data-id'=>1,'required']) }}
                    </td>
                    <td>
                        {{ Form::number('lot_no[]', null, ['class' => 'form-control', 'id' => 'lot_no1','required','placeholder'=>__('messages.purchase_medicine.lot_no')]) }}
                    </td>
                    <td>
                        {{ Form::text('expiry_date[]', null, ['class' => 'form-control purchaseMedicineExpiryDate', 'id' => 'expiry_date1','placeholder'=>__('messages.purchase_medicine.expiry_date')]) }}
                    </td>
                    <td>
                        {{ Form::number('sale_price[]', '0.00',['class' => 'form-control prescriptionMedicineMealId', 'readonly','id' => 'sale_price1','required']) }}
                    </td>
                    <td>
                        {{ Form::number('purchase_price[]', '0.00', ['class' => 'form-control purchase-price', 'readonly', 'rows'=>1, 'id' => 'purchase_price1','required' ]) }}
                    </td>
                    <td>
                        {{ Form::number('quantity[]', 0, ['class' => 'form-control purchase-quantity' ,'id'=>'quantity1','required']) }}
                    </td>
                    <td>
                        <div class="input-group flex-nowrap">
                        {{ Form::number('tax_medicine[]', 0, ['class' => 'form-control purchase-tax', 'rows'=>1, 'id'=>'tax1']) }}
                        <span class="input-group-text ms-0" id="amountTypeSymbol"> {{ __('%') }}</span>
                        </div>
                    </td>
                    <td>
                        {{ Form::number('amount[]','0.00', ['class' => 'form-control  purchase-amount','readonly', 'rows'=>1,'id'=>'amount1',]) }}
                    </td>
                    <td class="text-center">
                        <a href="javascript:void(0)" title="{{__('messages.common.delete')}}"
                           class="delete-purchase-medicine-item btn px-1 text-danger fs-3 pe-0">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
            </div>
            <div class="row mt-5 justify-content-between">
                <div class="col-md-6 mb-md-0 mb-5">
                    <label class="fw-bold text-muted py-3">{{ __('messages.purchase_medicine.note')  }}</label>
                    {{ Form::textarea('note', null, ['class' => 'form-control', 'rows'=>2,'Note','placeholder'=> __('messages.purchase_medicine.note')]) }}
                </div>
                <div class="col-xl-4 col-md-5">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <label class="fw-bold text-muted py-3 required me-5">{{ __('messages.purchase_medicine.total')  }}</label>
                        </div>
                        <div>
                            {{ Form::hidden('purchase_no',generateUniquePurchaseNumber(), ['class' => 'form-control']) }}
                            {{ Form::number('total', '0.00', ['class' => 'form-control required','readonly', 'rows'=>1,'id'=>'total',]) }}
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <label class="fw-bold text-muted required py-3 me-5">{{ __('messages.purchase_medicine.discount')  }}</label>
                        </div>
                        <div>
                            {{ Form::number('discount','0.00', ['class' => 'form-control purchase-discount required','id'=>'discountAmount']) }}
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <label class="fw-bold text-muted py-3">{{ __('messages.purchase_medicine.tax_amount')  }}</label>
                        </div>
                        <div>
                            <div class="input-group">
                            {{ Form::number('tax', '0.00', ['class' => 'form-control','id'=>'purchaseTaxId' ,'readonly','value'=>'0.00']) }}
                            {{--  <span class="input-group-text ms-0" id="amountTypeSymbol"> {{ __('$') }}</span>  --}}
                        </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <label class="fw-bold text-muted required py-3">{{ __('messages.purchase_medicine.net_amount')  }}</label>
                        </div>
                        <div>
                            {{ Form::number('net_amount', '0.00', ['class' => 'form-control required','id'=>'netAmount','readonly']) }}
                        </div>
                    </div>
                    <div class="d-sm-flex justify-content-between mb-3">
                        <div>
                            <label class="fw-bold text-muted required py-3">{{ __('messages.medicine_bills.payment_type')  }}</label>
                        </div>
                        <div>
                            {{ Form::select('payment_type', App\Models\PurchaseMedicine::PAYMENT_METHOD,null, ['class' => 'form-select', 'placeholder'=>__('messages.medicine_bills.payment_type'),'id'=>'paymentMode', 'required']) }}
                        </div>
                    </div>
                    <div>
                        <label class="fw-bold text-muted py-3">{{ __('messages.purchase_medicine.payment_note')  }}</label>
                        {{ Form::textarea('payment_note',null, ['class' => 'form-control', 'placeholder'=>__('messages.purchase_medicine.payment_note'),'rows'=>3]) }}
                    </div>
                    <div class="float-end mt-5">
                        {!! Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2','saveBtnPurchaseMedicne' ]) !!}
                        <a href="{!! route('medicine-purchase.index') !!}"
                           class="btn btn-secondary">{!! __('messages.common.cancel') !!}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
