<?php

namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

/**
 * Class UserRepository
 */
class SettingRepository extends BaseRepository
{
    public $fieldSearchable = [
        'clinic_name',
    ];

    /**
     * {@inheritDoc}
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * {@inheritDoc}
     */
    public function model()
    {
        return Setting::class;
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function update($input, $userId): void
    {
        $inputArr = Arr::except($input, ['_token']);

        if ($inputArr['sectionName'] == 'general') {
            $inputArr['clinic_name'] = (empty($inputArr['clinic_name'])) ? '' : $inputArr['clinic_name'];
            $inputArr['contact_no'] = (empty($inputArr['contact_no'])) ? '' : $inputArr['contact_no'];
            $inputArr['email'] = (empty($inputArr['email'])) ? '' : $inputArr['email'];
            $inputArr['specialities'] = (empty($inputArr['specialities'])) ? '1' : json_encode($inputArr['specialities']);
            $inputArr['currency'] = (empty($inputArr['currency'])) ? '1' : $inputArr['currency'];
            $inputArr['prefix'] = (empty($inputArr['prefix'])) ? '' : $inputArr['prefix'];
            $inputArr['region_code'] = (empty($inputArr['region_code'])) ? '' : $inputArr['region_code'];
            $inputArr['email_verified'] = (empty($inputArr['email_verified'])) ? '0' : $inputArr['email_verified'];
            $inputArr['default_country_code'] = (empty($inputArr['default_country_code'])) ? '' : $inputArr['default_country_code'];
            $inputArr['recaptcha'] = (empty($inputArr['recaptcha'])) ? 0 : $inputArr['recaptcha'];
            $inputArr['googleCaptchaKey'] = (empty($inputArr['googleCaptchaKey'])) ? '' : $inputArr['googleCaptchaKey'];
            $inputArr['googleCaptchaSecret'] = (empty($inputArr['googleCaptchaSecret'])) ? '' : $inputArr['googleCaptchaSecret'];
        }
        if ($inputArr['sectionName'] == 'contact_information') {
            $inputArr['address_one'] = (empty($inputArr['address_one'])) ? '' : $inputArr['address_one'];
            $inputArr['address_two'] = (empty($inputArr['address_two'])) ? '' : $inputArr['address_two'];
            $inputArr['country'] = (empty($inputArr['country'])) ? '1' : $inputArr['country'];
            $inputArr['state'] = (empty($inputArr['state'])) ? '1' : $inputArr['state'];
            $inputArr['city'] = (empty($inputArr['city'])) ? '1' : $inputArr['city'];
            $inputArr['postal_code'] = (empty($inputArr['postal_code'])) ? '' : $inputArr['postal_code'];
        }

        foreach ($inputArr as $key => $value) {

            /** @var Setting $setting */
            $setting = Setting::where('key', $key)->first();
            if (! $setting) {
                continue;
            }

            $setting->update(['value' => $value]);

            if (in_array($key, ['logo']) && ! empty($value)) {
                $setting->clearMediaCollection(Setting::LOGO);
                $media = $setting->addMedia($value)->toMediaCollection(Setting::LOGO, config('app.media_disc'));
                $setting->update(['value' => $media->getUrl()]);
            }

            if (in_array($key, ['favicon']) && ! empty($value)) {
                $setting->clearMediaCollection(Setting::FAVICON);
                $media = $setting->addMedia($value)->toMediaCollection(Setting::FAVICON, config('app.media_disc'));
                $setting->update(['value' => $media->getUrl()]);
            }
        }

        Cache::flush('settings');
        Cache::put('settings', Setting::all()->keyBy('key'));
    }
}
