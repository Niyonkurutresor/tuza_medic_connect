<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PrescriptionMedicineModal
 *
 * @property int $id
 * @property int $prescription_id
 * @property int $medicine
 * @property string|null $dosage
 * @property string|null $day
 * @property string|null $time
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Medicine[] $medicines
 * @property-read int|null $medicines_count
 * @property-read \App\Models\Prescription $prescription
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal query()
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal whereDosage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal whereMedicine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal wherePrescriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class PrescriptionMedicineModal extends Model
{
    use HasFactory;

    public $table = 'prescriptions_medicines';

    public $fillable = [
        'id',
        'prescription_id',
        'medicine',
        'dosage',
        'day',
        'time',
        'dose_interval',
        'comment',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'prescription_id' => 'integer',
        'medicine' => 'integer',
        'dosage' => 'string',
        'day' => 'string',
        'time' => 'string',
        'comment' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function prescription(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Prescription::class, 'prescription_id');
    }

    public function medicines(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Medicine::class, 'id', 'medicine');
    }
}
