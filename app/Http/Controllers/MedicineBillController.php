<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMedicineBillRequest;
use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\UpdateMedicineBillRequest;
use App\Models\Category;
use App\Models\Medicine;
use App\Models\MedicineBill;
use App\Models\SaleMedicine;
use App\Repositories\DoctorRepository;
use App\Repositories\MedicineBillRepository;
use App\Repositories\MedicineRepository;
use App\Repositories\PatientRepository;
use App\Repositories\PrescriptionRepository;
use \PDF;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Laracasts\Flash\Flash;

class MedicineBillController extends AppBaseController
{
    /* @var  PrescriptionRepository
          @var DoctorRepository
         */
    private $prescriptionRepository;

    private $medicineRepository;

    private $patientRepository;

    private $medicineBillRepository;

    public function __construct(
        PrescriptionRepository $prescriptionRepo,
        MedicineRepository $medicineRepository,
        PatientRepository $patientRepo,
        MedicineBillRepository $medicineBillRepository,
    ) {
        $this->prescriptionRepository = $prescriptionRepo;
        $this->medicineRepository = $medicineRepository;
        $this->patientRepository = $patientRepo;
        $this->medicineBillRepository = $medicineBillRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        return view('medicine-bills.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {

        $patients = $this->prescriptionRepository->getPatients();
        $doctors = $this->prescriptionRepository->getDoctors();
        $medicines = $this->prescriptionRepository->getMedicines();
        $data = $this->medicineRepository->getSyncList();
        $medicineList = $this->medicineRepository->getMedicineList();
        $mealList = $this->medicineRepository->getMealList();
        $medicineCategories = $this->medicineBillRepository->getMedicinesCategoriesData();
        $medicineCategoriesList = $this->medicineBillRepository->getMedicineCategoriesList();

        return view('medicine-bills.create',
            compact('patients', 'doctors', 'medicines', 'medicineList', 'mealList', 'medicineCategoriesList', 'medicineCategories'))->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateMedicineBillRequest $request): RedirectResponse
    {
        $input = $request->all();
        if (empty($input['medicine'])) {

            flash::error(__('messages.medicine_bills.medicine_not_selected'));

            return Redirect::route('medicine-bills.create');

        }
        $arr = collect($input['medicine']);
        $duplicateIds = $arr->duplicates();

        $input['payment_status'] = isset($input['payment_status']) ? 1 : 0;

        foreach ($input['medicine'] as $key => $value) {
            $medicine = Medicine::find($input['medicine'][$key]);
            if (! empty($duplicateIds)) {
                foreach ($duplicateIds as $key => $value) {
                    $medicine = Medicine::find($duplicateIds[$key]);

                    Flash::error(__('messages.medicine_bills.duplicate_medicine'));

                    return Redirect::route('medicine-bills.create');
                }
            }
            $qty = $input['quantity'][$key];
            if ($medicine->available_quantity < $qty) {
                $available = $medicine->available_quantity == null ? 0 : $medicine->available_quantity;
                Flash::error(__('messages.medicine_bills.available_quantity').' '.$medicine->name.' '.__('messages.medicine_bills.is').' '.$available.'.');

                return Redirect::route('medicine-bills.create');

            }
        }

        // dd($input);
        $medicineBill = MedicineBill::create([
            'bill_number' => 'BIL'.generateUniqueBillNumber(),
            'patient_id' => $input['patient_id'],
            'net_amount' => $input['net_amount'],
            'discount' => $input['discount'],
            'payment_status' => $input['payment_status'],
            'payment_type' => $input['payment_type'],
            'note' => $input['note'],
            'total' => $input['total'],
            'tax_amount' => $input['tax'],
            'payment_note' => $input['payment_note'],
            'model_type' => \App\Models\MedicineBill::class,
            'bill_date' => $input['bill_date'],
        ]);
        $medicineBill->update([
            'model_id' => $medicineBill->id,
        ]);
        if ($input['category_id']) {
            foreach ($input['category_id'] as $key => $value) {
                $medicine = Medicine::find($input['medicine'][$key]);
                $tax = $input['tax_medicine'][$key] == null ? $input['tax_medicine'][$key] : 0;
                SaleMedicine::create([
                    'medicine_bill_id' => $medicineBill->id,
                    'medicine_id' => $medicine->id,
                    'sale_price' => $input['sale_price'][$key],
                    'expiry_date' => $input['expiry_date'][$key],
                    'sale_quantity' => $input['quantity'][$key],
                    'tax' => $tax,

                ]);
                if ($input['payment_status'] == 1) {
                    $medicine->update([
                        'available_quantity' => $medicine->available_quantity - $input['quantity'][$key],
                    ]);
                }
            }
            Flash::success(__('messages.medicine_bills.medicine_bill').' '.__('messages.medicine.saved_successfully'));

            return Redirect::route('medicine-bills.index');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show(MedicineBill $medicineBill): View
    {
        $medicineBill->load(['saleMedicine.medicine']);

        return view('medicine-bills.show', compact('medicineBill'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicineBill $medicineBill): View
    {
        $medicineBill->load(['saleMedicine.medicine.category', 'saleMedicine.medicine.purchasedMedicine', 'patient', 'doctor']);

        $patients = $this->prescriptionRepository->getPatients();
        $doctors = $this->prescriptionRepository->getDoctors();
        $medicines = $this->prescriptionRepository->getMedicines();
        $data = $this->medicineRepository->getSyncList();
        $medicineList = $this->medicineRepository->getMedicineList();
        $mealList = $this->medicineRepository->getMealList();
        $medicineCategories = $this->medicineBillRepository->getMedicinesCategoriesData();
        $medicineCategoriesList = $this->medicineBillRepository->getMedicineCategoriesList();

        return view('medicine-bills.edit',
            compact('patients', 'doctors', 'medicines', 'medicineList', 'mealList', 'medicineBill', 'medicineCategoriesList', 'medicineCategories'))->with($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MedicineBill $medicineBill, UpdateMedicineBillRequest $request)
    {
        $input = $request->all();
        if (empty($input['medicine']) && $input['payment_status'] == false) {

            return $this->sendError(__('messages.medicine_bills.medicine_not_selected'));
        }
        $this->medicineBillRepository->update($medicineBill, $input);

        return $this->sendSuccess(__('messages.medicine_bills.medicine_bill').' '.__('messages.medicine.saved_successfully'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * *  @return \Illuminate\Http\Response
     */
    public function destroy(MedicineBill $medicineBill)
    {
        $medicineBill->saleMedicine()->delete();
        $medicineBill->delete();

        return $this->sendSuccess(__('messages.medicine_bills.medicine_bill').' '.__('messages.common.deleted_successfully'));
    }

    /** Store a newly created Patient in storage.
     */
    public function storePatient(CreatePatientRequest $request): JsonResponse
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;

        $this->patientRepository->store($input);
        $this->patientRepository->createNotification($input);
        $patients = $this->prescriptionRepository->getPatients();

        return $this->sendResponse($patients, __('messages.flash.Patient_saved'));
    }

    public function convertToPDF($id): Response
    {
        $data = $this->prescriptionRepository->getSettingList();
        $medicineBill = MedicineBill::with(['saleMedicine.medicine'])->where('id', $id)->first();

        $pdf = Pdf::loadView('medicine-bills.medicine_bill_pdf', compact('medicineBill', 'data'));

        return $pdf->stream('medicine-bill.pdf');
    }

    public function getMedicineCategory(Category $category): JsonResponse
    {
        $data = [];
        $data['category'] = $category;
        $data['medicine'] = Medicine::whereCategoryId($category->id)->pluck('name', 'id')->toArray();

        return $this->sendResponse($data, 'retrieved');
    }
}
