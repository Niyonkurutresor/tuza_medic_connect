<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;

class PatientAppointmentController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        $allPaymentStatus = getAllPaymentStatus();
        $paymentStatus = Arr::except($allPaymentStatus, [Appointment::MANUALLY]);
        $paymentGateway = getPaymentGateway();
        $logo = Setting::where('key', 'logo')->pluck('value');

        return view('patients.appointments.index', compact('paymentStatus', 'paymentGateway','logo'));
    }
}
