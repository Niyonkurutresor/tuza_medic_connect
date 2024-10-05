<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\VisitObservation
 *
 * @property int $id
 * @property string $observation_name
 * @property int $visit_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation query()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation whereObservationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation whereVisitId($value)
 *
 * @mixin \Eloquent
 */
class VisitObservation extends Model
{
    use HasFactory;

    public $table = 'visit_observations';

    public $fillable = [
        'observation_name',
        'visit_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'observation_name' => 'string',
        'visit_id' => 'integer',
    ];

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }
}
