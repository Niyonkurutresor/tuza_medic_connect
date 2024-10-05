<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class FrontPatientTestimonial
 *
 * @version September 22, 2021, 11:20 am UTC
 *
 * @property int $id
 * @property string $name
 * @property string $designation
 * @property string $short_description
 * @property int $is_default
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Database\Factories\FrontPatientTestimonialFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontPatientTestimonial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontPatientTestimonial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontPatientTestimonial query()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontPatientTestimonial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontPatientTestimonial whereDesignation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontPatientTestimonial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontPatientTestimonial whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontPatientTestimonial whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontPatientTestimonial whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontPatientTestimonial whereUpdatedAt($value)
 *
 * @mixin Model
 */
class FrontPatientTestimonial extends Model implements hasMedia
{
    use HasFactory, InteractsWithMedia;

    const FRONT_PATIENT_PROFILE = 'profile';

    public $table = 'front_patient_testimonials';

    public $fillable = [
        'name',
        'designation',
        'short_description',
        'is_default',
    ];

    protected $casts = [
        'name' => 'string',
        'designation' => 'string',
        'short_description' => 'string',
        'is_default' => 'boolean',
    ];

    protected $appends = ['front_patient_profile'];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'designation' => 'required',
        'short_description' => 'required|max:111',
        'profile' => 'required|mimes:jpeg,jpg,png|max:2000',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $editRules = [
        'name' => 'required',
        'designation' => 'required',
        'short_description' => 'required|max:111',
        'profile' => 'nullable|mimes:jpeg,jpg,png|max:2000',
    ];

    public function getFrontPatientProfileAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::FRONT_PATIENT_PROFILE)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('web/media/avatars/male.png');
    }
}
