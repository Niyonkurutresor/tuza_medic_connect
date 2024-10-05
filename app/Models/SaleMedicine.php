<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\SaleMedicine
 *
 * @property int $id
 * @property int $medicine_bill_id
 * @property int $medicine_id
 * @property int $sale_quantity
 * @property float $tax
 * @property float $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Medicine|null $medicine
 * @property-read \App\Models\MedicineBill|null $medicineBill
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine query()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine whereMedicineBillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine whereMedicineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine whereSaleQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class SaleMedicine extends Model
{
    use HasFactory;

    protected $table = 'sale_medicines';

    protected $fillable = [
        'medicine_bill_id',
        'medicine_id',
        'sale_quantity',
        'sale_price',
        'tax',
    ];

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }

    public function medicineBill(): BelongsTo
    {
        return $this->belongsTo(MedicineBill::class, 'medicine_bill_id');
    }
}
