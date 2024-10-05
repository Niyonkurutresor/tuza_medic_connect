<?php

namespace App\Http\Controllers;

use App\Repositories\DashboardRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class DashboardController extends AppBaseController
{
    /* @var DashboardRepository */
    private $dashboardRepository;

    /**
     * DashboardController constructor.
     */
    public function __construct(DashboardRepository $dashboardRepo)
    {
        $this->dashboardRepository = $dashboardRepo;
    }

    /**
     * @return Application|Factory|View|JsonResponse
     */
    public function index(Request $request)
    {
        $data = $this->dashboardRepository->getData();
        $appointmentChartData = $this->dashboardRepository->getAppointmentChartData($request->all());
        $clinic_name = Setting::where('key','clinic_name')->pluck('value')->first();
        if ($request->ajax()) {
            $appointmentFilterChartData = $this->dashboardRepository->getAppointmentChartData($request->all());

            return $this->sendResponse($appointmentFilterChartData, __('messages.filter_success'));
        }

        return view('dashboard.index', compact('data', 'appointmentChartData','clinic_name'));
    }

    /**
     * @param  Request  $request  *
     */
    public function getPatientList(Request $request)
    {
        $input = $request->all();

        $data['patients'] = $this->dashboardRepository->patientData($input);

        return $this->sendResponse($data, __('messages.flash.patients_retrieve'));
    }

    /**
     * @return Application|Factory|View
     */
    public function doctorDashboard(Request $request): \Illuminate\View\View
    {
        $appointments = $this->dashboardRepository->getDoctorData();
        $doctorAllAppointment = $this->dashboardRepository->doctorAllAppointment();
        return view('doctor_dashboard.index', compact('appointments','doctorAllAppointment'));
    }

    public function getDoctorAppointment(Request $request): JsonResponse
    {
        $input = $request->all();
        $data['patients'] = $this->dashboardRepository->doctorAppointment($input);

        return $this->sendResponse($data, __('messages.flash.patients_retrieve'));
    }

    /**
     * @return Application|Factory|View
     */
    public function patientDashboard(): \Illuminate\View\View
    {
        $data = $this->dashboardRepository->getPatientData();
        $logo = Setting::where('key', 'logo')->pluck('value');
        $patientAllAppointment = $this->dashboardRepository->patientAllAppointment();
        return view('patient_dashboard.index', compact('data','logo','patientAllAppointment'));
    }
}
