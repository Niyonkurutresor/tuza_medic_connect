<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UsedMedicine
 *
 * @property int $id
 * @property int $stock_used
 * @property int|null $medicine_id
 * @property int $model_id
 * @property string $model_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UsedMedicine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsedMedicine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsedMedicine query()
 * @method static \Illuminate\Database\Eloquent\Builder|UsedMedicine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsedMedicine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsedMedicine whereMedicineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsedMedicine whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsedMedicine whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsedMedicine whereStockUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsedMedicine whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class UsedMedicine extends Model
{
    protected $fillable =
    [
        'medicine_id',
        'stock_used',
        'model_id',
        'model_type',
    ];

    protected $table = 'used_medicines';

    public function medicine()
    {

        return $this->belongsTo(Medicine::class, 'medicine_id');
    }
}
