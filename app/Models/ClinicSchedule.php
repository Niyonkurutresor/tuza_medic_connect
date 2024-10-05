<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ClinicSchedule
 *
 * @property int $id
 * @property string $day_of_week
 * @property string $start_time
 * @property string $end_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule whereDayOfWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class ClinicSchedule extends Model
{
    use HasFactory;

    protected $table = 'clinic_schedules';

    const Mon = 1;

    const Tue = 2;

    const Wed = 3;

    const Thu = 4;

    const Fri = 5;

    const Sat = 6;

    const Sun = 0;

    const WEEKDAY = [
        self::Mon => 'MON',
        self::Tue => 'TUE',
        self::Wed => 'WED',
        self::Thu => 'THU',
        self::Fri => 'FRI',
        self::Sat => 'SAT',
        self::Sun => 'SUN',
    ];

    const WEEKDAY_FULL_NAME = [
        self::Mon => 'Monday',
        self::Tue => 'Tuesday',
        self::Wed => 'Wednesday',
        self::Thu => 'Thursday',
        self::Fri => 'Friday',
        self::Sat => 'Saturday',
        self::Sun => 'Sunday',
    ];

    public $fillable = [
        'day_of_week',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'day_of_week' => 'string',
        'start_time' => 'string',
        'end_time' => 'string',
    ];
}
