<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMedicineRequest;
use App\Http\Requests\UpdateMedicineRequest;
use App\Models\Medicine;
use App\Models\PurchasedMedicine;
use App\Models\SaleMedicine;
use App\Repositories\MedicineRepository;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Response;

class MedicineController extends AppBaseController
{
    /** @var MedicineRepository */
    private $medicineRepository;

    public function __construct(MedicineRepository $medicineRepo)
    {
        $this->medicineRepository = $medicineRepo;
    }

    /**
     * Display a listing of the Medicine.
     *
     * @param  Request  $request
     * @return Factory|View|Response
     *
     * @throws Exception
     */
    public function index(): View
    {
        return view('medicines.index');
    }

    /**
     * Show the form for creating a new Medicine.
     *
     * @return Factory|View
     */
    public function create(): View
    {
        $data = $this->medicineRepository->getSyncList();

        return view('medicines.create')->with($data);
    }

    /**
     * Store a newly created Medicine in storage.
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreateMedicineRequest $request): RedirectResponse
    {
        $input = $request->all();

        $this->medicineRepository->create($input);

        Flash::success(__('messages.medicine.medicine').' '.__('messages.medicine.saved_successfully'));

        return redirect(route('medicines.index'));
    }

    /**
     * Display the specified Medicine.
     *
     * @return Factory|View
     */
    public function show(Medicine $medicine): View
    {
        $medicine->brand;
        $medicine->category;

        return view('medicines.show')->with('medicine', $medicine);
    }

    /**
     * Show the form for editing the specified Medicine.
     *
     * @return Factory|View
     */
    public function edit(Medicine $medicine): View
    {
        $data = $this->medicineRepository->getSyncList();
        $data['medicine'] = $medicine;

        return view('medicines.edit')->with($data);
    }

    /**
     * Update the specified Medicine in storage.
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Medicine $medicine, UpdateMedicineRequest $request): RedirectResponse
    {
        $this->medicineRepository->update($request->all(), $medicine->id);

        Flash::success(__('messages.medicine.medicine').' '.__('messages.medicine.updated_successfully'));

        return redirect(route('medicines.index'));
    }

    /**
     * Remove the specified Medicine from storage.
     *
     *
     * @throws Exception
     */
    public function destroy(Medicine $medicine): JsonResponse
    {
        if (! canAccessRecord(Medicine::class, $medicine->id)) {
            return $this->sendError(__('messages.flash.medicine_not_found'));
        }
        $purchaseMedicine = PurchasedMedicine::whereMedicineId($medicine->id)->first();
        $saleMedicine = SaleMedicine::whereMedicineId($medicine->id)->first();
        if (isset($purchaseMedicine) && ! empty($purchaseMedicine)) {
            $purchaseMedicine->delete();
        }
        if (isset($saleMedicine) && ! empty($saleMedicine)) {
            $saleMedicine->delete();
        }
        $this->medicineRepository->delete($medicine->id);

        return $this->sendSuccess(__('messages.medicine.medicine').' '.__('messages.medicine.deleted_successfully'));
    }

    /**
     * @throws \Gerardojbaez\Money\Exceptions\CurrencyException
     */
    public function showModal(Medicine $medicine): JsonResponse
    {
        $medicine->load(['brand', 'category']);

        $currency = $medicine->currency_symbol ? strtoupper($medicine->currency_symbol) : strtoupper(getCurrentCurrency());
        $medicine = [
            'name' => $medicine->name,
            'brand_name' => $medicine->brand->name,
            'category_name' => $medicine->category->name,
            'salt_composition' => $medicine->salt_composition,
            'side_effects' => $medicine->side_effects,
            'created_at' => $medicine->created_at,
            'selling_price' => getCurrencyFormat(getCurrencyCode(), $medicine->buying_price),
            'buying_price' => getCurrencyFormat(getCurrencyCode(), $medicine->buying_price),
            'updated_at' => $medicine->updated_at,
            'description' => $medicine->description,
            'quantity' => $medicine->quantity,
            'available_quantity' => $medicine->available_quantity,
        ];

        return $this->sendResponse($medicine, __('messages.medicine.medicine_retrieved_successfully'));
    }

    public function checkUseOfMedicine(Medicine $medicine)
    {

        $SaleModel = [
            SaleMedicine::class,
            PurchasedMedicine::class,
        ];
        $result['result'] = canDelete($SaleModel, 'medicine_id', $medicine->id);
        $result['id'] = $medicine->id;

        if ($result) {

            return $this->sendResponse($result, __('messages.medicine_bills.the_medicine_already_in_use'));
        }

        return $this->sendResponse($result, __('messages.medicine.no_use'));

    }
}
