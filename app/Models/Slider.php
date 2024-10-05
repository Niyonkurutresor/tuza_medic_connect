<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\Slider
 *
 * @property int $id
 * @property string $title
 * @property string $short_description
 * @property int $is_default
 * @property-read string $slider_image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereIsDefault($value)
 */
class Slider extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const SLIDER_IMAGE = 'image';

    /**
     * @var string[]
     */
    public static $rules = [
        'title' => 'required',
        'image' => 'required|mimes:jpeg,png,jpg',
        'short_description' => 'required',
    ];

    /**
     * @var string[]
     */
    public static $editRules = [
        'title' => 'required',
        'image' => 'nullable|mimes:jpeg,png,jpg',
        'short_description' => 'required|max:55',
    ];

    /**
     * @var string
     */
    protected $table = 'sliders';

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'short_description',
        'is_default',
    ];

    protected $casts = [
        'title' => 'string',
        'short_description' => 'string',
        'is_default' => 'boolean',
    ];

    protected $appends = ['slider_image'];

    public function getSliderImageAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::SLIDER_IMAGE)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('assets/front/images/home/home-page-image.png');
    }
}
