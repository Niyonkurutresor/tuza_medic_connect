<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GoogleCalendarIntegration
 *
 * @property int $id
 * @property int $user_id
 * @property string $access_token
 * @property mixed $meta
 * @property string $last_used_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarIntegration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarIntegration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarIntegration query()
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarIntegration whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarIntegration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarIntegration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarIntegration whereLastUsedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarIntegration whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarIntegration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarIntegration whereUserId($value)
 *
 * @mixin \Eloquent
 */
class GoogleCalendarIntegration extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'access_token',
        'meta',
        'last_used_at',
    ];

    protected $casts = [
        'meta' => 'json',
    ];
}
