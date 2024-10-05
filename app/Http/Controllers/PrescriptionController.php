<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMedicineRequest;
use App\Http\Requests\CreatePrescriptionRequest;
use App\Http\Requests\UpdatePrescriptionRequest;
use App\Models\Appointment;
use App\Models\Medicine;
use App\Models\Prescription;
use App\Repositories\DoctorRepository;
use App\Repositories\MedicineRepository;
use App\Repositories\PrescriptionRepository;
use \PDF;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PrescriptionController extends AppBaseController
{
    /** @var  PrescriptionRepository
     * @var DoctorRepository
     */
    private $prescriptionRepository;

    private $medicineRepository;

    public function __construct(
        PrescriptionRepository $prescriptionRepo,
        MedicineRepository $medicineRepository
    ) {
        $this->prescriptionRepository = $prescriptionRepo;
        $this->medicineRepository = $medicineRepository;
    }

    /**
     * Show the form for creating a new Prescription.
     *
     * @return Factory|View
     */
    public function create($appointmentId): View
    {
        $patients = $this->prescriptionRepository->getPatients();
        $doctors = $this->prescriptionRepository->getDoctors();
        $medicines = $this->prescriptionRepository->getMedicines();
        $medicinesQuantity = $this->prescriptionRepository->getMedicinesQuantity();
        $data = $this->medicineRepository->getSyncList();
        $medicineList = $this->medicineRepository->getMedicineList();
        $mealList = $this->medicineRepository->getMealList();
        $doseDuration = $this->medicineRepository->getDoseDurationList();
        $doseInverval = $this->medicineRepository->getDoseInterValList();
        $appointment = Appointment::with('doctor','patient')->find($appointmentId);

        return view('prescriptions.create',
            compact('patients', 'doctors','appointment', 'medicines','medicinesQuantity', 'medicineList', 'mealList', 'doseDuration', 'doseInverval', 'appointmentId'))->with($data);
    }

    /**
     * Store a newly created Prescription in storage.
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreatePrescriptionRequest $request): RedirectResponse
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;

        if (isset($input['medicine'])) {
            $arr = collect($input['medicine']);
            $duplicateIds = $arr->duplicates();
            foreach ($input['medicine'] as $key => $value) {
                $medicine = Medicine::find($input['medicine'][$key]);
                if (! empty($duplicateIds)) {
                    foreach ($duplicateIds as $key => $value) {
                        $medicine = Medicine::find($duplicateIds[$key]);
                        Flash::error(__('messages.prescription.not_add_duplicate_medicines'));

                        return Redirect::back();
                    }
                }
            }
            foreach ($input['medicine'] as $key => $value) {
                $medicine = Medicine::find($input['medicine'][$key]);
                $qty = $input['day'][$key] * $input['dose_interval'][$key];
                if ($medicine->available_quantity < $qty) {
                    $available = $medicine->available_quantity == null ? 0 : $medicine->available_quantity;
                    // Flash::error('The available quantity of '.$medicine->name.' is '.$available.'.');
                    Flash::error(__('messages.prescription.available_quantity_of').$medicine->name.' '.__('messages.prescription.is').' '.$available.'.');

                    return Redirect::back();

                }
            }
        }

        $prescription = $this->prescriptionRepository->create($input);
        $showRoute = isRole('doctor') ? 'doctors.appointment.detail' : (isRole('patient') ? 'patients.appointment.detail' : 'appointments.show');
        $this->prescriptionRepository->createPrescription($input, $prescription);
        Flash::success(__('messages.prescription.prescription_saved'));

        return redirect(route($showRoute, $input['appointment_id']));
    }

    /**
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function show(Prescription $prescription)
    {
        if (! canAccessRecord(Prescription::class, $prescription->id)) {
            Flash::error(__('messages.flash.not_allow_access_record'));

            return Redirect::back();
        }

        $prescription = $this->prescriptionRepository->find($prescription->id);
        if (empty($prescription)) {
            Flash::error(__('messages.flash.prescription_not_found'));

            return Redirect::back();
        }

        return view('prescriptions.show')->with('prescription', $prescription);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|RedirectResponse
     */
    public function edit($appointmentId, Prescription $prescription)
    {
        if (! canAccessRecord(Prescription::class, $prescription->id)) {
            Flash::error(__('messages.flash.not_allow_access_record'));

            return Redirect::back();
        }

        if (getLogInUser()->hasRole('Doctor')) {
            $patientPrescriptionHasDoctor = Prescription::whereId($prescription->id)->whereDoctorId(getLogInUser()->owner_id)->exists();
            if (! $patientPrescriptionHasDoctor) {
                return Redirect::back();
            }
        }

        $appointment = Appointment::with('doctor','patient')->find($appointmentId);

        $patients = $this->prescriptionRepository->getPatients();
        $doctors = $this->prescriptionRepository->getDoctors();
        $data['medicines'] = Medicine::pluck('name', 'id')->toArray();
        $medicines = $data;
        $data = $this->medicineRepository->getSyncList();
        $medicineList = $this->medicineRepository->getMedicineList();
        $mealList = $this->medicineRepository->getMealList();
        $doseDuration = $this->medicineRepository->getDoseDurationList();
        $doseInverval = $this->medicineRepository->getDoseInterValList();

        return view('prescriptions.edit', compact('patients','appointment', 'appointmentId', 'prescription', 'doctors', 'medicines', 'medicineList', 'mealList', 'doseDuration', 'doseInverval'))->with($data);
    }

    /**
     * @return RedirectResponse|Redirector
     */
    public function update(Prescription $prescription, UpdatePrescriptionRequest $request): RedirectResponse
    {
        $prescription = $this->prescriptionRepository->find($prescription->id);
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;
        $prescription->load('getMedicine');
        $arr = collect($input['medicine']);
        $duplicateIds = $arr->duplicates();
        foreach ($input['medicine'] as $key => $value) {
            $medicine = Medicine::find($input['medicine'][$key]);
            if (! empty($duplicateIds)) {
                foreach ($duplicateIds as $key => $value) {
                    $medicine = Medicine::find($duplicateIds[$key]);
                    Flash::error(__('messages.prescription.not_add_duplicate_medicines'));

                    return Redirect::back();
                }
            }
        }
        $prescriptionMedicineArray = [];
        $inputdoseAndMedicine = [];
        foreach ($prescription->getMedicine as $prescriptionMedicine) {
            $prescriptionMedicineArray[$prescriptionMedicine->medicine] = $prescriptionMedicine->dosage;
        }
        foreach ($request->medicine as $key => $value) {
            $inputdoseAndMedicine[$value] = $request->dosage[$key];
        }

        if (empty($prescription)) {
            Flash::error(__('messages.flash.prescription_not_found'));

            return Redirect::back();
        }

        foreach ($input['medicine'] as $key => $value) {
            // dump($prescriptionMedicineArray);
            // dump($inputdoseAndMedicine);
            $result = array_intersect($prescriptionMedicineArray, $inputdoseAndMedicine);
            // dump($result);
            // dd(!array_key_exists($input['medicine'][$key], $result));
            $medicine = Medicine::find($input['medicine'][$key]);
            $qty = $input['day'][$key] * $input['dose_interval'][$key];

            if (! array_key_exists($input['medicine'][$key], $result) && $medicine->available_quantity < $qty) {
                $available = $medicine->available_quantity == null ? 0 : $medicine->available_quantity;
                // Flash::error('The available quantity of '.$medicine->name.' is '.$available.'.');
                Flash::error(__('messages.prescription.available_quantity_of').$medicine->name.__('messages.prescription.is').$available.'.');

                return Redirect::back();
            }
        }
        $showRoute = isRole('doctor') ? 'doctors.appointment.detail' : (isRole('patient') ? 'patients.appointment.detail' : 'appointments.show');
        $this->prescriptionRepository->prescriptionUpdate($prescription, $request->all());
        Flash::success(__('messages.prescription.prescription_updated'));

        return redirect(route($showRoute, $input['appointment_id']));
    }

    /**
     * @return JsonResponse|RedirectResponse|Redirector
     *
     * @throws Exception
     */
    public function destroy(Prescription $prescription)
    {
        if (! canAccessRecord(Prescription::class, $prescription->id)) {
            return $this->sendError(__('messages.flash.prescription_not_found'));
        }

        if (getLogInUser()->hasRole('Doctor')) {
            $patientPrescriptionHasDoctor = Prescription::whereId($prescription->id)->whereDoctorId(getLogInUser()->owner_id)->exists();
            if (! $patientPrescriptionHasDoctor) {
                return $this->sendError(__('messages.flash.prescription_not_found'));
            }
        }

        $prescription = $this->prescriptionRepository->find($prescription->id);
        if (empty($prescription)) {
            Flash::error(__('messages.flash.prescription_not_found'));

            return Redirect::back();
        }
        $prescription->delete();

        return $this->sendSuccess(__('messages.flash.prescription_deleted'));
    }

    public function activeDeactiveStatus(int $id): JsonResponse
    {
        $prescription = Prescription::findOrFail($id);
        $status = ! $prescription->status;
        $prescription->update(['status' => $status]);

        return $this->sendSuccess(__('messages.flash.status_update'));
    }

    public function showModal($id): JsonResponse
    {
        if (getLogInUser()->hasRole('Doctor')) {
            $patientPrescriptionHasDoctor = Prescription::whereId($id)->whereDoctorId(getLogInUser()->owner_id)->exists();
            if (! $patientPrescriptionHasDoctor) {
                return $this->sendError(__('messages.flash.prescription_not_found'));
            }
        }

        $prescription = $this->prescriptionRepository->find($id);
        $prescription->load(['patient.patientUser', 'doctor.doctorUser']);
        if (empty($prescription)) {
            return $this->sendError(__('messages.flash.prescription_not_found'));
        }

        return $this->sendResponse($prescription, __('messages.flash.prescription_retrieved'));
    }

    public function prescreptionMedicineStore(CreateMedicineRequest $request): JsonResponse
    {
        $input = $request->all();
        $this->medicineRepository->create($input);

        return $this->sendSuccess(__('messages.medicine.medicine').' '.__('messages.medicine.saved_successfully'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View
     */
    public function prescriptionMedicineShowFunction($id)
    {
        if (getLogInUser()->hasRole('Doctor')) {
            $patientPrescriptionHasDoctor = Prescription::whereId($id)->whereDoctorId(getLogInUser()->owner_id)->exists();
            if (! $patientPrescriptionHasDoctor) {
                return Redirect::back();
            }
        }

        $data = $this->prescriptionRepository->getSettingList();

        $prescription = $this->prescriptionRepository->getData($id);

        $medicines = $this->prescriptionRepository->getMedicineData($id);

        return view('prescriptions.show_with_medicine', compact('prescription', 'medicines', 'data'));
    }

    public function convertToPDF($id): \Illuminate\Http\Response
    {
        $data = $this->prescriptionRepository->getSettingList();

        $prescription = $this->prescriptionRepository->getData($id);

        $medicines = $this->prescriptionRepository->getMedicineData($id);

        $pdf = PDF::loadView('prescriptions.prescription_pdf', compact('prescription', 'medicines', 'data'));

        return $pdf->stream($prescription['prescription']->patient->user->full_name.'-'.$prescription['prescription']->id);
    }
}
