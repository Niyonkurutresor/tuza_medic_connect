<?php

namespace App\MediaLibrary;

use App\Models\FrontPatientTestimonial;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\User;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

/**
 * Class CustomPathGenerator
 */
class CustomPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        $path = '{PARENT_DIR}'.DIRECTORY_SEPARATOR.$media->id.DIRECTORY_SEPARATOR;

        switch ($media->collection_name) {
            case User::PROFILE:
                return str_replace('{PARENT_DIR}', User::PROFILE, $path);
            case Patient::PROFILE:
                return str_replace('{PARENT_DIR}', Patient::PROFILE, $path);
            case Setting::LOGO:
                return str_replace('{PARENT_DIR}', Setting::LOGO, $path);
            case Setting::FAVICON:
                return str_replace('{PARENT_DIR}', Setting::FAVICON, $path);
            case Slider::SLIDER_IMAGE:
                return str_replace('{PARENT_DIR}', Slider::SLIDER_IMAGE, $path);
            case FrontPatientTestimonial::FRONT_PATIENT_PROFILE:
                return str_replace('{PARENT_DIR}', FrontPatientTestimonial::FRONT_PATIENT_PROFILE, $path);
            case Service::ICON:
                return str_replace('{PARENT_DIR}', Service::ICON, $path);
            case 'default':
                return '';
        }
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media).'thumbnails/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media).'rs-images/';
    }
}
