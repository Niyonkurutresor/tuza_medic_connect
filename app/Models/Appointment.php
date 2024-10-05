<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * App\Models\Appointment
 *
 * @property int $id
 * @property int $doctor_id
 * @property int $patient_id
 * @property string $date
 * @property string $from_time
 * @property string $from_time_type
 * @property string $to_time
 * @property string $to_time_type
 * @property int $status
 * @property string|null $description
 * @property int $service_id
 * @property string $payable_amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\Doctor $doctor
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\Service $services
 * @property-read \App\Models\User $user
 *
 * @method static \Database\Factories\AppointmentFactory factory(...$parameters)
 * @method static Builder|Appointment newModelQuery()
 * @method static Builder|Appointment newQuery()
 * @method static Builder|Appointment query()
 * @method static Builder|Appointment whereCreatedAt($value)
 * @method static Builder|Appointment whereDate($value)
 * @method static Builder|Appointment whereDescription($value)
 * @method static Builder|Appointment whereDoctorId($value)
 * @method static Builder|Appointment whereFromTime($value)
 * @method static Builder|Appointment whereFromTimeType($value)
 * @method static Builder|Appointment whereId($value)
 * @method static Builder|Appointment wherePatientId($value)
 * @method static Builder|Appointment wherePayableAmount($value)
 * @method static Builder|Appointment whereServiceId($value)
 * @method static Builder|Appointment whereStatus($value)
 * @method static Builder|Appointment whereToTime($value)
 * @method static Builder|Appointment whereToTimeType($value)
 * @method static Builder|Appointment whereUpdatedAt($value)
 *
 * @mixin Model
 *
 * @property string $appointment_unique_id
 *
 * @method static Builder|Appointment whereAppointmentUniqueId($value)
 *
 * @property-read mixed $status_name
 */
class Appointment extends Model
{
    use HasFactory;

    public $table = 'appointments';

    public $fillable = [
        'doctor_id',
        'patient_id',
        'date',
        'from_time',
        'description',
        'status',
        'to_time',
        'service_id',
        'payable_amount',
        'appointment_unique_id',
        'from_time_type',
        'to_time_type',
        'payment_type',
        'payment_method',
    ];

    protected $casts = [
        'doctor_id' => 'integer',
        'patient_id' => 'integer',
        'date' => 'string',
        'from_time' => 'string',
        'description' => 'string',
        'status' => 'integer',
        'to_time' => 'string',
        'service_id' => 'integer',
        'payable_amount' => 'string',
        'appointment_unique_id' => 'string',
        'from_time_type' => 'string',
        'to_time_type' => 'string',
    ];

    const ALL = 0;

    const BOOKED = 1;

    const CHECK_IN = 2;

    const CHECK_OUT = 3;

    const CANCELLED = 4;

    const STATUS = [
        self::ALL => 'All',
        self::BOOKED => 'Booked',
        self::CHECK_IN => 'Check In',
        self::CHECK_OUT => 'Check Out',
        self::CANCELLED => 'Cancelled',
    ];

    const ALL_STATUS = [
        self::ALL => 'All',
        self::BOOKED => 'Booked',
        self::CHECK_IN => 'Check In',
        self::CHECK_OUT => 'Check Out',
        self::CANCELLED => 'Cancelled',
    ];

    const BOOKED_STATUS_ARRAY = [
        self::BOOKED => 'Booked',
    ];

    const PATIENT_STATUS = [
        self::BOOKED => 'Booked',
        self::CANCELLED => 'Cancelled',
    ];

    const ALL_PAYMENT = 0;

    const PENDING = 1;

    const PAID = 2;

    const PAYMENT_TYPE = [
        self::PENDING => 'Pending',
        self::PAID => 'Paid',
    ];

    const PAYMENT_TYPE_ALL = [
        self::ALL_PAYMENT => 'All',
        self::PENDING => 'Pending',
        self::PAID => 'Paid',
    ];

    const MANUALLY = 1;

    const STRIPE = 2;

    const PAYSTACK = 3;

    const PAYPAL = 4;

    const RAZORPAY = 5;

    const AUTHORIZE = 6;

    const PAYTM = 7;
    const MOMO = 8;


    const PAYMENT_METHOD = [
        self::MANUALLY => 'Manually',
        self::STRIPE => 'Stripe',
        self::PAYSTACK => 'Paystack',
        self::PAYPAL => 'Paypal',
        self::RAZORPAY => 'Razorpay',
        self::AUTHORIZE => 'Authorize',
        self::PAYTM => 'Paytm',
        self::MOMO => 'Momo',

    ];

    const PAYMENT_GATEWAY = [
        self::STRIPE => 'Stripe',
        self::PAYSTACK => 'Paystack',
        self::PAYPAL => 'Paypal',
        self::RAZORPAY => 'Razorpay',
        self::AUTHORIZE => 'Authorize',
       self::PAYTM => 'Paytm',
       self::MOMO => 'Momo',

    ];
    // const MOMO = 1;

    // const PAYMENT_METHOD = [
    //     self::MOMO => 'Momo',
    // ];

    // const PAYMENT_GATEWAY = [
    //     self::MOMO => 'Momo',
    // ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'doctor_id' => 'required',
        'patient_id' => 'required',
        'date' => 'required',
        'service_id' => 'required',
        'payable_amount' => 'required',
        'from_time' => 'required',
        'to_time' => 'required',
        'payment_type' => 'required',
    ];

    public static function generateAppointmentUniqueId(): string
    {
        $appointmentUniqueId = Str::random(10);
        while (true) {
            $isExist = self::whereAppointmentUniqueId($appointmentUniqueId)->exists();
            if ($isExist) {
                self::generateAppointmentUniqueId();
            }
            break;
        }

        return $appointmentUniqueId;
    }

    public function getStatusNameAttribute()
    {
        return self::STATUS[$this->status];
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    /**
     * @return mixed
     */
    public function services()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return mixed
     */
    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'appointment_id', 'appointment_unique_id');
    }
}
