<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SmartPatientCards extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasRoles;

    protected $table = 'smart_patient_cards';

    const PROFILE = 'profile';

    /**
     * @var string[]
     */
    protected $fillable = [
        'template_name',
        'address',
        'header_color',
        'show_email',
        'show_phone',
        'show_dob',
        'show_blood_group',
        'show_address',
        'show_patient_unique_id',
    ];

    public static $rules = [
        'template_name' => 'required|unique:smart_patient_cards,template_name',
    ];

    protected $appends = ['profile_image',];

    public function getProfileImageAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PROFILE)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }
        return asset('web/media/avatars/male.png');
    }


    public function patient():HasOne
    {
        return $this->hasOne(Patient::class,'template_id');
    }
}
