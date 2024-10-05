<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServicesRequest;
use App\Http\Requests\UpdateServicesRequest;
use App\Models\Appointment;
use App\Models\Service;
use App\Repositories\ServicesRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;

class ServiceController extends AppBaseController
{
    /** @var ServicesRepository */
    private $servicesRepository;

    public function __construct(ServicesRepository $servicesRepo)
    {
        $this->servicesRepository = $servicesRepo;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        $status = Service::STATUS;

        return view('services.index', compact('status'));
    }

    /**
     * Show the form for creating a new Services.
     *
     * @return Application|Factory|View
     */
    public function create(): \Illuminate\View\View
    {
        $data = $this->servicesRepository->prepareData();

        return view('services.create', compact('data'));
    }

    /**
     * Store a newly created Services in storage.
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateServicesRequest $request): RedirectResponse
    {
        $input = $request->all();
        $this->servicesRepository->store($input);

        Flash::success(__('messages.flash.service_create'));

        return redirect(route('services.index'));
    }

    /**
     * Show the form for editing the specified Services.
     *
     * @return Application|Factory|View
     */
    public function edit(Service $service): \Illuminate\View\View
    {
        $data = $this->servicesRepository->prepareData();
        $selectedDoctor = $service->serviceDoctors()->pluck('doctor_id')->toArray();

        return view('services.edit', compact('service', 'data', 'selectedDoctor'));
    }

    /**
     * Update the specified Services in storage.
     *
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UpdateServicesRequest $request, Service $service): RedirectResponse
    {
        $this->servicesRepository->update($request->all(), $service);

        Flash::success(__('messages.flash.service_update'));

        return redirect(route('services.index'));
    }

    /**
     * Remove the specified Services from storage.
     */
    public function destroy(Service $service): JsonResponse
    {
        $checkRecord = Appointment::whereServiceId($service->id)->exists();

        if ($checkRecord) {
            return $this->sendError(__('messages.flash.service_use'));
        }
        $service->delete();

        return $this->sendSuccess(__('messages.flash.service_delete'));
    }

    public function getService(Request $request)
    {
        $doctor_id = $request->appointmentDoctorId;
        $service = Service::with('serviceDoctors')->whereHas('serviceDoctors', function ($q) use ($doctor_id) {
            $q->where('doctor_id', $doctor_id)->whereStatus(Service::ACTIVE);
        })->get();

        return $this->sendResponse($service, __('messages.flash.retrieve'));
    }

    public function getCharge(Request $request): JsonResponse
    {
        $chargeId = $request->chargeId;
        $charge = Service::find($chargeId);

        return $this->sendResponse($charge, __('messages.flash.retrieve'));
    }

    /**
     * @return mixed
     */
    public function changeServiceStatus(Request $request)
    {
        $status = Service::findOrFail($request->id);
        $status->update(['status' => ! $status->status]);

        return $this->sendResponse($status, __('messages.flash.status_update'));
    }
}
