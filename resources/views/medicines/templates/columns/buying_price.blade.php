<div>
    @if($row->buying_price)
        {{ getCurrencyFormat(getCurrencyCode(),$row->buying_price) }}
    @else
        {{__('messages.common.n/a')}}
    @endif
</div>
