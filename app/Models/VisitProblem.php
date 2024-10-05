<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\VisitProblem
 *
 * @property int $id
 * @property string $problem_name
 * @property int $visit_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|VisitProblem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitProblem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitProblem query()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitProblem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitProblem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitProblem whereProblemName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitProblem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitProblem whereVisitId($value)
 *
 * @mixin \Eloquent
 */
class VisitProblem extends Model
{
    use HasFactory;

    public $table = 'visit_problems';

    public $fillable = [
        'problem_name',
        'visit_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'problem_name' => 'string',
        'visit_id' => 'integer',
    ];

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }
}
