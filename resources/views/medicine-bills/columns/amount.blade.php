<div class="d-flex align-items-center justify-content-end mt-2">
    @if(!empty($row->net_amount))
        <p class="cur-margin text-end">{{ getCurrencyFormat(getCurrencyCode(),$row->net_amount) }}
            @else
                {{ __('messages.common.n/a') }}
    @endif
</div>
