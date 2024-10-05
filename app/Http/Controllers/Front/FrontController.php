<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\AppBaseController;
use App\Models\ClinicSchedule;
use App\Models\Doctor;
use App\Models\DoctorSession;
use App\Models\Faq;
use App\Models\FrontPatientTestimonial;
use App\Models\Patient;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     */
    public function medical(): \Illuminate\View\View
    {
        $doctors = Doctor::with('user', 'specializations')->whereHas('user', function (Builder $query) {
            $query->where('status', User::ACTIVE);
        })->latest()->take(10)->get()->pluck('user.full_name', 'id');
        $sliders = Slider::with('media')->first();
        $frontMedicalServicesArray = Service::with('media')->whereStatus(Service::ACTIVE)->latest()->get()->toArray();
        $frontMedicalServices = array_chunk($frontMedicalServicesArray, 2);
        $frontPatientTestimonials = FrontPatientTestimonial::with('media')->latest()->take(6)->get();
        $aboutExperience = Setting::where('key', 'about_experience')->first();

        return view('fronts.medicals.index',
            compact('doctors', 'sliders', 'frontMedicalServices', 'frontPatientTestimonials',
                'aboutExperience'));
    }

    /**
     * @return Application|Factory|View
     */
    public function medicalAboutUs(): \Illuminate\View\View
    {
        $data = [];
        $data['doctorsCount'] = Doctor::with('user')->get()->where('user.status', true)->count();
        $data['patientsCount'] = Patient::get()->count();
        $data['servicesCount'] = Service::whereStatus(true)->get()->count();
        $data['specializationsCount'] = Specialization::get()->count();
        $clinicSchedules = ClinicSchedule::all();
        $setting = Setting::where('key', 'about_us_image')->first();
        $frontPatientTestimonials = FrontPatientTestimonial::with('media')->latest()->take(6)->get();
        $doctors = Doctor::with('user', 'appointments', 'specializations')->whereHas('user', function (Builder $query) {
            $query->where('status', User::ACTIVE);
        })->withCount('appointments')->orderBy('appointments_count', 'desc')->take(3)->get();

        return view('fronts.medical_about_us',
            compact('doctors', 'data', 'setting', 'clinicSchedules', 'frontPatientTestimonials'));
    }

    /**
     * @return Application|Factory|View
     */
    public function medicalServices(): \Illuminate\View\View
    {
        $data = [];
        $serviceCategories = ServiceCategory::with('activatedServices')->withCount('services')->get();
        $setting = Setting::pluck('value', 'key')->toArray();
        $services = Service::with('media')->whereStatus(Service::ACTIVE)->latest()->get();
        $data['doctorsCount'] = Doctor::with('user')->get()->where('user.status', true)->count();
        $data['patientsCount'] = Patient::get()->count();
        $data['servicesCount'] = Service::whereStatus(true)->get()->count();
        $data['specializationsCount'] = Specialization::get()->count();

        return view('fronts.medical_services', compact('serviceCategories', 'setting', 'services', 'data'));
    }

    /**
     * @return Application|Factory|View
     */
    public function medicalAppointment(): \Illuminate\View\View
    {
        $faqs = Faq::latest()->get();

        $appointmentDoctors = Doctor::with('user')->whereIn('id',
            DoctorSession::pluck('doctor_id')->toArray())->get()->where('user.status',
                User::ACTIVE)->pluck('user.full_name', 'id');

        return view('fronts.medical_appointment', compact('faqs', 'appointmentDoctors'));
    }

    /**
     * @return Application|Factory|View
     */
    public function medicalDoctors(): \Illuminate\View\View
    {
        $doctors = Doctor::with('specializations', 'user')->whereHas('user', function (Builder $query) {
            $query->where('status', User::ACTIVE);
        })->latest()->take(9)->get();

        return view('fronts.medical_doctors', compact('doctors'));
    }

    /**
     * @return Application|Factory|View
     */
    public function medicalContact(): \Illuminate\View\View
    {
        $clinicSchedules = ClinicSchedule::all();

        return view('fronts.medical_contact', compact('clinicSchedules'));
    }

    /**
     * @return Application|Factory|View
     */
    public function termsCondition(): \Illuminate\View\View
    {
        $termConditions = Setting::pluck('value', 'key')->toArray();

        return view('fronts.terms_conditions', compact('termConditions'));
    }

    /**
     * @return Application|Factory|View
     */
    public function privacyPolicy(): \Illuminate\View\View
    {
        $privacyPolicy = Setting::pluck('value', 'key')->toArray();

        return view('fronts.privacy_policy', compact('privacyPolicy'));
    }

    /**
     * @return Application|Factory|View
     */
    public function faq(): \Illuminate\View\View
    {
        $faqs = Faq::latest()->get();

        return view('fronts.faq', compact('faqs'));
    }

    /**
     * @return mixed
     */
    public function changeLanguage(Request $request)
    {
        Session::put('languageName', $request->input('languageName'));

        return $this->sendSuccess(__('messages.flash.language_change'));
    }
}
