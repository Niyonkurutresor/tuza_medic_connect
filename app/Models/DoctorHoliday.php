<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DoctorHoliday
 *
 * @property int $id
 * @property string|null $name
 * @property int $doctor_id
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Doctor $doctor
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorHoliday newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorHoliday newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorHoliday query()
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorHoliday whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorHoliday whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorHoliday whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorHoliday whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorHoliday whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorHoliday whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class DoctorHoliday extends Model
{
    use HasFactory;

    public $table = 'doctor_holidays';

    public $fillable = [
        'doctor_id',
        'date',
        'name',
    ];

    public static $rules = [
        'doctor_id' => 'required',
        'date' => 'required',
    ];

    const ALL = 0;

    const UPCOMING_HOLIDAY = 1;

    const PAST_HOLIDAY = 2;

    const TODAY = 3;

    const ALL_STATUS = [
        self::ALL => 'All',
        self::TODAY => 'Today',
        self::UPCOMING_HOLIDAY => 'Upcoming Holidays',
        self::PAST_HOLIDAY => 'Past Holidays',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
