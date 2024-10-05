<div class="card-toolbar ms-auto">
    <div class="dropdown">
        <a href="#" class="btn btn-primary dropdown-toggle" id="dropdownMenuButton"
           data-bs-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">{{ __('messages.purchase_medicine.actions') }}
        </a>
        <ul class="dropdown-menu action-dropdown" aria-labelledby="dropdownMenuButton">
            <li>
                <a href="{{ route('medicine-purchase.create') }}"
                   class="dropdown-item  px-5">{{ __('messages.purchase_medicine.purchase_medicine') }}</a>
            </li>
            <li>
                <a
                        href="{{ route('purchase-medicine.excel') }}"
                   class="dropdown-item  px-5" data-turbo="false">{{ __('messages.purchase_medicine.export_to_excel') }}</a>
            </li>
        </ul>
    </div>
</div>
