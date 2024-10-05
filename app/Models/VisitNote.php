<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\VisitNote
 *
 * @property int $id
 * @property string $note_name
 * @property int $visit_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|VisitNote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitNote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitNote query()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitNote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitNote whereNoteName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitNote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitNote whereVisitId($value)
 *
 * @mixin \Eloquent
 */
class VisitNote extends Model
{
    use HasFactory;

    public $table = 'visit_notes';

    public $fillable = [
        'note_name',
        'visit_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'note_name' => 'string',
        'visit_id' => 'integer',
    ];

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }
}
