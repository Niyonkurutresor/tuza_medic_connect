<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use App\Models\Setting;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $captchakey = Setting::where('key','googleCaptchaKey')->pluck('value')->first();
        return view('auth.register',compact('captchakey'));
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:users,email',
            'password' => ['required', 'confirmed', 'min:6'],
            'toc' => 'required',
        ]);

        $datas1 = Setting::where('key','recaptcha')->first();
        if($datas1->value){
            $request->validate([
                'g-recaptcha-response' => 'required',
            ],
            [
                'g-recaptcha-response.required' => __('messages.common.google_captcha_required'),
            ]);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => User::PATIENT,
            'language' => getSettingValue('language'),
        ]);

        $user->patient()->create([
            'patient_unique_id' => mb_strtoupper(Patient::generatePatientUniqueId()),
        ]);

        $user->assignRole('patient');

        $user->sendEmailVerificationNotification();

        Flash::success(__('messages.flash.your_reg_success'));

        return redirect('login');
    }
}
