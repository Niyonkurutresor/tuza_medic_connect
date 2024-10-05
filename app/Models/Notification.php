<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Notification
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $type
 * @property string|null $description
 * @property string|null $read_at
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Notification extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
        'type',
        'description',
        'read_at',
        'user_id',
    ];

    protected $casts = [
        'title' => 'string',
        'type' => 'string',
        'description' => 'string',
        'read_at' => 'timestamp',
        'user_id' => 'integer',
    ];

    const BOOKED = 'booked';

    const CHECKOUT = 'checkout';

    const CHECKIN = 'checkin';

    const CANCELED = 'canceled';

    const PAYMENT_DONE = 'payment_done';

    const REVIEW = 'review';

    const LIVE_CONSULTATION = 'live_consultation';

    const APPOINTMENT_CREATE_DOCTOR_MSG = 'booked appointment with you at';

    const APPOINTMENT_CREATE_PATIENT_MSG = 'Your Appointment has been booked between';

    const APPOINTMENT_CANCEL_PATIENT_MSG = 'Your Appointment has been cancelled by';

    const APPOINTMENT_CANCEL_DOCTOR_MSG = 'cancelled appointment with you at';

    const APPOINTMENT_PAYMENT_DONE_PATIENT_MSG = 'Your appointment payment has been successful';

    const APPOINTMENT_CHECKOUT_PATIENT_MSG = 'Your Appointment has been checkout by';
    const APPOINTMENT_CHECKIN_PATIENT_MSG = 'Your Appointment has been checked in by';

}
