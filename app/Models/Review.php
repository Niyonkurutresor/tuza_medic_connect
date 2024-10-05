<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Review
 *
 * @property int $id
 * @property int $patient_id
 * @property int $doctor_id
 * @property string $review
 * @property int $rating
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review query()
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Review extends Model
{
    use HasFactory;

    public $fillable = [
        'patient_id',
        'doctor_id',
        'review',
        'rating',
    ];

    protected $casts = [
        'patient_id' => 'integer',
        'doctor_id' => 'integer',
        'review' => 'string',
        'rating' => 'integer',
    ];

    const STAR_RATING_1 = 1;

    const STAR_RATING_2 = 2;

    const STAR_RATING_3 = 3;

    const STAR_RATING_4 = 4;

    const STAR_RATING_5 = 5;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'doctor_id' => 'required',
        'review' => 'required|max:121',
        'rating' => 'required',
    ];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
