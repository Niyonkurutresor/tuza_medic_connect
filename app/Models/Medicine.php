<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Medicine
 *
 * @property int $id
 * @property int|null $category_id
 * @property int|null $brand_id
 * @property string $name
 * @property float $selling_price
 * @property float $buying_price
 * @property int $quantity
 * @property int $available_quantity
 * @property string $salt_composition
 * @property string|null $description
 * @property string|null $side_effects
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Brand|null $brand
 * @property-read \App\Models\Category|null $category
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine query()
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereAvailableQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereBuyingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereSaltComposition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereSellingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereSideEffects($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Medicine extends Model
{
    public $table = 'medicines';

    public $fillable = [
        'category_id',
        'brand_id',
        'name',
        'selling_price',
        'buying_price',
        'side_effects',
        'description',
        'salt_composition',
        'currency_symbol',
        'quantity',
        'available_quantity',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'brand_id' => 'integer',
        'name' => 'string',
        'selling_price' => 'double',
        'buying_price' => 'double',
        'side_effects' => 'string',
        'description' => 'string',
        'salt_composition' => 'string',
        'currency_symbol' => 'string',
        'quantity' => 'integer',
        'available_quantity' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'category_id' => 'required',
        'brand_id' => 'required',
        'name' => 'required|min:2|unique:medicines,name',
        'selling_price' => 'required',
        'buying_price' => 'required',
        'side_effects' => 'nullable',
        'salt_composition' => 'required|string',
        // 'quantity'    => 'required|integer',
        // 'available_quantity' => 'required|integer|lte:quantity'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function prescriptionMedicines(): BelongsTo
    {
        return $this->belongsTo(PrescriptionMedicineModal::class, 'medicine');
    }

    public function usedMedicines(): BelongsTo
    {
        return $this->belongsTo(UsedMedicine::class);
    }

    public function purchasedMedicine(): BelongsTo
    {
        return $this->belongsTo(PurchasedMedicine::class);
    }
}
