<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UpdateFrontCmsRequest;
use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;

class CMSController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        $cmsData = Setting::pluck('value', 'key')->toArray();

        return view('fronts.cms.cms', compact('cmsData'));
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateFrontCmsRequest $request): RedirectResponse
    {
        $data = [];
        $input = $request->all();
        $data['terms_conditions'] = json_decode($input['terms_conditions']);
        $data['privacy_policy'] = json_decode($input['privacy_policy']);
        $data['about_title'] = $input['about_title'];
        $data['about_short_description'] = $input['about_short_description'];
        $data['about_experience'] = $input['about_experience'];

        if (isset($input['about_image_1'])) {
            $setting = Setting::where('key', 'about_image_1')->first();
            $setting->clearMediaCollection(Setting::IMAGE);
            $media = $setting->addMedia($input['about_image_1'])->toMediaCollection(Setting::IMAGE, config('app.media_disc'));
            $setting->update(['value' => $media->getUrl()]);
        }

        if (isset($input['about_image_2'])) {
            $setting = Setting::where('key', 'about_image_2')->first();
            $setting->clearMediaCollection(Setting::IMAGE);
            $media = $setting->addMedia($input['about_image_2'])->toMediaCollection(Setting::IMAGE, config('app.media_disc'));
            $setting->update(['value' => $media->getUrl()]);
        }

        if (isset($input['about_image_3'])) {
            $setting = Setting::where('key', 'about_image_3')->first();
            $setting->clearMediaCollection(Setting::IMAGE);
            $media = $setting->addMedia($input['about_image_3'])->toMediaCollection(Setting::IMAGE, config('app.media_disc'));
            $setting->update(['value' => $media->getUrl()]);
        }

        foreach ($data as $key => $value) {

            /** @var Setting $setting */
            $setting = Setting::where('key', $key)->first();
            if (! $setting) {
                continue;
            }

            $setting->update(['value' => $value]);
        }

        Flash::success(__('messages.flash.cms_update'));

        return redirect(route('cms.index'));
    }
}
