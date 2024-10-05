<?php

namespace App\Repositories;

use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\MedicineBill;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\PrescriptionMedicineModal;
use App\Models\SaleMedicine;
use App\Models\Setting;
use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class PrescriptionRepository
 *
 * @version March 31, 2020, 12:22 pm UTC
 */
class PrescriptionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'patient_id',
        'food_allergies',
        'tendency_bleed',
        'heart_disease',
        'high_blood_pressure',
        'diabetic',
        'surgery',
        'accident',
        'others',
        'medical_history',
        'current_medication',
        'female_pregnancy',
        'breast_feeding',
        'health_insurance',
        'low_income',
        'reference',
        'status',
    ];

    /**
     * Return searchable fields
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Prescription::class;
    }

    public function getPatients(): \Illuminate\Support\Collection
    {
        $user = Auth::user();
        if ($user->hasRole('Doctor')) {
            $patients = getPatientsList($user->owner_id);
        } else {
            $patients = Patient::with('user')
                ->whereHas('user', function (Builder $query) {
                    $query->where('status', 1);
                })->get()->pluck('user.full_name', 'id')->sort();
        }

        return $patients;
    }

    /**
     * @param  array  $prescription
     * @return bool|Builder|Builder[]|Collection|Model
     */
    //    public function update($prescription, $input)
    //    {
    //        try {
    //            /** @var Prescription $prescription */
    //            $prescription->update($input);
    //
    //            return true;
    //        } catch (Exception $e) {
    //            throw new UnprocessableEntityHttpException($e->getMessage());
    //        }
    //    }

    public function createNotification(array $input)
    {
        try {
            $patient = Patient::with('user')->where('id', $input['patient_id'])->first();

            addNotification([
                Notification::NOTIFICATION_TYPE['Prescription'],
                $patient->user_id,
                Notification::NOTIFICATION_FOR[Notification::PATIENT],
                $patient->user->full_name.' your prescription has been created.',
            ]);
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function getMedicines(): array
    {
        $data['medicines'] = Medicine::where('available_quantity', '>', 0)->pluck('name', 'id')->toArray();

        return $data;
    }

    public function getMedicinesQuantity() {
        $data = Medicine::where('available_quantity', '>', 0)->pluck('quantity')->toArray();
        return $data;
    }

    public function createPrescription(array $input, Model $prescription)
    {
        try {
            DB::beginTransaction();

            $amount = 0;
            $qty = 0;
            if (isset($input['medicine'])) {
                $medicineBill = MedicineBill::create([
                    'bill_number' => 'BIL'.generateUniqueBillNumber(),
                    'patient_id' => $input['patient_id'],
                    'doctor_id' => $input['doctor_id'],
                    'model_type' => \App\Models\Prescription::class,
                    'model_id' => $prescription->id,
                    'bill_date' => Carbon::now(),
                    'payment_status' => MedicineBill::UNPAID,
                ]);
                foreach ($input['medicine'] as $key => $value) {
                    $PrescriptionItem = [
                        'prescription_id' => $prescription->id,
                        'medicine' => $input['medicine'][$key],
                        'dosage' => $input['dosage'][$key],
                        'day' => $input['day'][$key],
                        'time' => $input['time'][$key],
                        'dose_interval' => $input['dose_interval'][$key],
                        'comment' => $input['comment'][$key],
                    ];
                    $prescriptionMedcine = PrescriptionMedicineModal::create($PrescriptionItem);
                    $medicine = Medicine::find($input['medicine'][$key]);
                    $amount += $input['day'][$key] * $input['dose_interval'][$key] * $medicine->selling_price;
                    $qty = $input['day'][$key] * $input['dose_interval'][$key];
                    $saleMedicineArray = [
                        'medicine_bill_id' => $medicineBill->id,
                        'medicine_id' => $medicine->id,
                        'sale_quantity' => $qty,
                        'sale_price' => $medicine->selling_price,
                        'tax' => 0,

                    ];
                    SaleMedicine::create($saleMedicineArray);
                }
                $medicineBill->update([
                    'net_amount' => $amount,
                    'total' => $amount,
                ]);
            }
            DB::commit();
        } catch (Exception $e) {

            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function prescriptionUpdate($prescription, $input)
    {
        try {
            DB::beginTransaction();
            $prescriptionMedicineArr = \Arr::only($input, $this->model->getFillable());
            $prescription->update($prescriptionMedicineArr);
            $medicineBill = MedicineBill::with('saleMedicine')->whereModelType(\App\Models\Prescription::class)->whereModelId($prescription->id)->first();
            $prescription->getMedicine()->delete();
            $medicineBill->saleMedicine()->delete();
            $amount = 0;
            $qty = 0;

            if (! empty($input['medicine'])) {
                foreach ($input['medicine'] as $key => $value) {
                    $PrescriptionItem = [
                        'prescription_id' => $prescription->id,
                        'medicine' => $input['medicine'][$key],
                        'dosage' => $input['dosage'][$key],
                        'day' => $input['day'][$key],
                        'time' => $input['time'][$key],
                        'dose_interval' => $input['dose_interval'][$key],
                        'comment' => $input['comment'][$key],
                    ];
                    $prescriptionMedcine = PrescriptionMedicineModal::create($PrescriptionItem);

                    $medicine = Medicine::find($input['medicine'][$key]);
                    $amount += $input['day'][$key] * $input['dose_interval'][$key] * $medicine->selling_price;
                    $qty = $input['day'][$key] * $input['dose_interval'][$key];
                    $saleMedicineArray = [
                        'medicine_bill_id' => $medicineBill->id,
                        'medicine_id' => $medicine->id,
                        'sale_quantity' => $qty,
                        'sale_price' => $medicine->selling_price,
                        'tax' => 0,

                    ];
                    SaleMedicine::create($saleMedicineArray);
                }
                $medicineBill->update([
                    'net_amount' => $amount,
                    //  'discount'=>$input['discount'],
                    //  'tax_amount'=>$input['tax'],
                ]);

            }
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }

        return $prescription;
    }

    public function getData($id): array
    {
        $data['prescription'] = Prescription::with('patient', 'doctor', 'getMedicine.medicines')
            ->findOrFail($id);

        return $data;
    }

    public function getMedicineData($id): array
    {
        $data = $this->getData($id)['prescription'];
        $medicines = [];
        foreach ($data->getMedicine as $medicine) {
            $data['medicine'] = Medicine::where('id', $medicine->medicine)->get();
            array_push($medicines, $data['medicine']);
        }

        return $medicines;
    }

    public function getSettingList(): array
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return $settings;
    }

    public function getDoctors()
    {
        /** @var Doctor $doctors */
        $doctors = Doctor::with('doctorUser')->get()->where('doctorUser.status', '=', 1)->pluck('doctorUser.full_name', 'id')->sort();

        return $doctors;
    }
}
