<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Models\Medicine;
use App\Repositories\BrandRepository;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class BrandController extends AppBaseController
{
    /** @var BrandRepository */
    private $brandRepository;

    public function __construct(BrandRepository $brandRepo)
    {
        $this->brandRepository = $brandRepo;
    }

    /**
     * Display a listing of the Brand.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index(): View
    {
        return view('brands.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View
    {
        return view('brands.create');
    }

    /**
     * Store a newly created Brand in storage.
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateBrandRequest $request): RedirectResponse
    {
        $input = $request->all();
        $input['phone'] = preparePhoneNumber($input, 'phone');
        $this->brandRepository->create($input);
        Flash::success(__('messages.medicine_brands').' '.__('messages.medicine.saved_successfully'));

        return redirect(route('brands.index'));
    }

    /**
     * @return Factory|View
     */
    public function show(Brand $brand): View
    {
        $medicines = $brand->medicines;

        return view('brands.show', compact('medicines', 'brand'));
    }

    /**
     * Show the form for editing the specified Brand.
     *
     * @return Application|Factory|View
     */
    public function edit(Brand $brand): View
    {
        return view('brands.edit', compact('brand'));
    }

    /**
     * Update the specified Brand in storage.
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Brand $brand, UpdateBrandRequest $request): RedirectResponse
    {
        $input = $request->all();
        $input['phone'] = preparePhoneNumber($input, 'phone');
        $this->brandRepository->update($input, $brand->id);
        Flash::success(__('messages.medicine_brands').' '.__('messages.medicine.updated_successfully'));

        return redirect(route('brands.index'));
    }

    /**
     * Remove the specified Brand from storage.
     *
     *
     * @throws Exception
     */
    public function destroy(Brand $brand): JsonResponse
    {
        $medicineBrandModel = [
            Medicine::class,
        ];
        $result = canDelete($medicineBrandModel, 'brand_id', $brand->id);
        if ($result) {
            return $this->sendError(__('messages.medicine_brands').' '.__('messages.medicine.cant_be_deleted'));
        }
        $brand->delete($brand->id);

        return $this->sendSuccess(__('messages.medicine_brands').' '.__('messages.medicine.deleted_successfully'));
    }
}
