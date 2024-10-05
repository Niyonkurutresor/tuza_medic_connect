<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\GoogleCalendarList
 *
 * @property int $id
 * @property int $user_id
 * @property string $calendar_name
 * @property string $google_calendar_id
 * @property mixed $meta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AppointmentGoogleCalendar $appointmentGoogleCalendar
 *
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarList query()
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarList whereCalendarName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarList whereGoogleCalendarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarList whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarList whereUserId($value)
 *
 * @mixin \Eloquent
 */
class GoogleCalendarList extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'calendar_name',
        'google_calendar_id',
        'meta',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'calendar_name' => 'string',
        'google_calendar_id' => 'string',
        'meta' => 'json',
    ];

    public function appointmentGoogleCalendar(): BelongsTo
    {
        return $this->belongsTo(AppointmentGoogleCalendar::class);
    }
}
