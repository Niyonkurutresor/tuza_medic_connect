<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PaymentGateway
 *
 * @property int $id
 * @property int $payment_gateway_id
 * @property string $payment_gateway
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway wherePaymentGateway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway wherePaymentGatewayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class PaymentGateway extends Model
{
    use HasFactory;

    protected $table = 'payment_gateways';

    protected $fillable = [
        'payment_gateway_id',
        'payment_gateway',
    ];

    protected $casts = [
        'payment_gateway_id' => 'integer',
        'payment_gateway' => 'string',
    ];
}
