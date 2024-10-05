<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Prescription
 *
 * @property int $id
 * @property int $appointment_id
 * @property int $patient_id
 * @property int|null $doctor_id
 * @property string|null $food_allergies
 * @property string|null $tendency_bleed
 * @property string|null $heart_disease
 * @property string|null $high_blood_pressure
 * @property string|null $diabetic
 * @property string|null $surgery
 * @property string|null $accident
 * @property string|null $others
 * @property string|null $medical_history
 * @property string|null $current_medication
 * @property string|null $female_pregnancy
 * @property string|null $breast_feeding
 * @property string|null $health_insurance
 * @property string|null $low_income
 * @property string|null $reference
 * @property bool|null $status
 * @property string|null $plus_rate
 * @property string|null $temperature
 * @property string|null $problem_description
 * @property string|null $test
 * @property string|null $advice
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Doctor|null $doctor
 * @property-read \App\Models\Patient $patient
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription query()
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereAccident($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereAdvice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereAppointmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereBreastFeeding($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereCurrentMedication($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereDiabetic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereFemalePregnancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereFoodAllergies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereHealthInsurance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereHeartDisease($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereHighBloodPressure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereLowIncome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereMedicalHistory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereOthers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription wherePlusRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereProblemDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereSurgery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereTemperature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereTendencyBleed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereTest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Prescription extends Model
{
    public $table = 'prescriptions';

    public $fillable = [
        'patient_id',
        'doctor_id',
        'food_allergies',
        'tendency_bleed',
        'heart_disease',
        'high_blood_pressure',
        'diabetic',
        'surgery',
        'accident',
        'others',
        'medical_history',
        'current_medication',
        'female_pregnancy',
        'breast_feeding',
        'health_insurance',
        'low_income',
        'reference',
        'status',
        'plus_rate',
        'temperature',
        'problem_description',
        'test',
        'advice',
        'appointment_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'patient_id' => 'integer',
        'appointment_id' => 'integer',
        'food_allergies' => 'string',
        'tendency_bleed' => 'string',
        'heart_disease' => 'string',
        'high_blood_pressure' => 'string',
        'diabetic' => 'string',
        'surgery' => 'string',
        'accident' => 'string',
        'others' => 'string',
        'medical_history' => 'string',
        'current_medication' => 'string',
        'female_pregnancy' => 'string',
        'breast_feeding' => 'string',
        'health_insurance' => 'string',
        'low_income' => 'string',
        'reference' => 'string',
        'status' => 'boolean',
        'plus_rate' => 'string',
        'temperature' => 'string',
        'problem_description' => 'string',
        'test' => 'string',
        'advice' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'patient_id' => 'required',
    ];

    const STATUS_ALL = 2;

    const ACTIVE = 1;

    const INACTIVE = 0;

    const STATUS_ARR = [
        self::STATUS_ALL => 'All',
        self::ACTIVE => 'Active',
        self::INACTIVE => 'Deactive',
    ];

    const DAYS = 0;

    const MONTH = 1;

    const YEAR = 2;

    const TIME_ARR = [
        self::DAYS => 'Days',
        self::MONTH => 'Month',
        self::YEAR => 'Years',
    ];

    const AFETR_MEAL = 0;

    const BEFORE_MEAL = 1;

    const MEAL_ARR = [
        self::AFETR_MEAL => 'After Meal',
        self::BEFORE_MEAL => 'Before Meal',
    ];

    const ONE_TIME = 1;

    const TWO_TIME = 2;

    const THREE_TIME = 3;

    const FOUR_TIME = 4;

    const DOSE_INTERVAL = [

        self::ONE_TIME => 'Every Morning',
        self::TWO_TIME => 'Every Morning & Evening',
        self::THREE_TIME => 'Three times a day',
        self::FOUR_TIME => '4 times a day',
    ];

    const ONE_DAY = 1;

    const THREE_DAY = 3;

    const ONE_WEEK = 7;

    const TWO_WEEK = 14;

    const ONE_MONTH = 30;

    const DOSE_DURATION = [
        self::ONE_DAY => 'One day only',
        self::THREE_DAY => 'For Three days',
        self::ONE_WEEK => 'For One week',
        self::TWO_WEEK => 'For 2 weeks',
        self::ONE_MONTH => 'For 1 Month',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function getMedicine(): HasMany
    {
        return $this->hasMany(PrescriptionMedicineModal::class);
    }
}
