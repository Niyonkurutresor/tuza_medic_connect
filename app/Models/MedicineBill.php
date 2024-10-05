<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\MedicineBill
 *
 * @property int $id
 * @property string $bill_number
 * @property int $patient_id
 * @property int|null $doctor_id
 * @property string $model_type
 * @property string $model_id
 * @property int|null $case_id
 * @property int $admission_id
 * @property float $discount
 * @property float $amount
 * @property float $paid_amount
 * @property int $payment_status
 * @property float $balance_amount
 * @property int $payment_type
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Doctor|null $doctor
 * @property-read \App\Models\Patient|null $patient
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SaleMedicine[] $saleMedicine
 * @property-read int|null $sale_medicine_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill query()
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereAdmissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereBalanceAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereBillNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereCaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill wherePaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 *
 * @property float $net_amount
 *
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereNetAmount($value)
 *
 * @property float $total
 * @property float $tax_amount
 *
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereTaxAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereTotal($value)
 */
class MedicineBill extends Model
{
    use HasFactory;

    protected $table = 'medicine_bills';

    protected $fillable = [
        'bill_number',
        'patient_id',
        'doctor_id',
        'model_type',
        'model_id',
        'case_id',
        'admission_id',
        'discount',
        'net_amount',
        'payment_status',
        'payment_type',
        'note',
        'tax_amount',
        'total',
        'bill_date',
    ];

    const UNPAID = 0;

    const FULLPAID = 1;

    const PARTIALY_PAID = 2;

    const PAYMENT_STATUS_ARRAY =
    [
        self::UNPAID => 'Unpaid',
        self::FULLPAID => 'Full Paid',
        self::PARTIALY_PAID => 'Partially Paid',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function saleMedicine(): HasMany
    {
        return $this->hasMany(SaleMedicine::class, 'medicine_bill_id');
    }
}
