<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\PurchasedMedicine
 *
 * @property int $id
 * @property int $purchase_medicines_id
 * @property int|null $medicine_id
 * @property string|null $expiry_date
 * @property string $lot_no
 * @property float $tax
 * @property int $quantity
 * @property float $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Medicine|null $medicines
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine query()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine whereExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine whereLotNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine whereMedicineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine wherePurchaseMedicinesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class PurchasedMedicine extends Model
{
    protected $fillable =
        [
            'purchase_medicines_id',
            'medicine_id',
            'lot_no',
            'expiry_date',
            'quantity',
            'amount',
            'tax',
            'tenant_id',
        ];

    public function medicines(): BelongsTo
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }
}
