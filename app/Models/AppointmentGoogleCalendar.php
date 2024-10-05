<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\AppointmentGoogleCalendar
 *
 * @property int $id
 * @property int $user_id
 * @property int $google_calendar_list_id
 * @property string $google_calendar_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\GoogleCalendarList $googleCalendarList
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentGoogleCalendar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentGoogleCalendar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentGoogleCalendar query()
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentGoogleCalendar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentGoogleCalendar whereGoogleCalendarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentGoogleCalendar whereGoogleCalendarListId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentGoogleCalendar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentGoogleCalendar whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentGoogleCalendar whereUserId($value)
 *
 * @mixin \Eloquent
 */
class AppointmentGoogleCalendar extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'google_calendar_list_id',
        'google_calendar_id',
    ];

    public function googleCalendarList(): BelongsTo
    {
        return $this->BelongsTo(GoogleCalendarList::class);
    }
}
