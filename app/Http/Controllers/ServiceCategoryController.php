<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServiceCategoryRequest;
use App\Http\Requests\UpdateServiceCategoryRequest;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Repositories\ServiceCategoryRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class ServiceCategoryController extends AppBaseController
{
    /** @var ServiceCategoryRepository */
    private $serviceCategoryRepository;

    public function __construct(ServiceCategoryRepository $serviceCategoryRepo)
    {
        $this->serviceCategoryRepository = $serviceCategoryRepo;
    }

    /**
     * Display a listing of the ServiceCategory.
     *
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        return view('service_categories.index');
    }

    /**
     * Store a newly created ServiceCategory in storage.
     */
    public function store(CreateServiceCategoryRequest $request): JsonResponse
    {
        $input = $request->all();
        $serviceCategory = $this->serviceCategoryRepository->create($input);

        return $this->sendResponse($serviceCategory, __('messages.flash.service_cat_create'));
    }

    /**
     * Show the form for editing the specified ServiceCategory.
     */
    public function edit(ServiceCategory $serviceCategory): JsonResponse
    {
        return $this->sendResponse($serviceCategory, __('messages.flash.cat_retrieve'));
    }

    /**
     * Update the specified ServiceCategory in storage.
     */
    public function update(UpdateServiceCategoryRequest $request, ServiceCategory $serviceCategory): JsonResponse
    {
        $input = $request->all();
        $this->serviceCategoryRepository->update($input, $serviceCategory->id);

        return $this->sendSuccess(__('messages.flash.service_cat_update'));
    }

    /**
     * Remove the specified ServiceCategory from storage.
     */
    public function destroy(ServiceCategory $serviceCategory): JsonResponse
    {
        $checkRecord = Service::whereCategoryId($serviceCategory->id)->exists();

        if ($checkRecord) {
            return $this->sendError(__('messages.flash.service_cat_use'));
        }
        $serviceCategory->delete();

        return $this->sendSuccess(__('messages.flash.service_cat_delete'));
    }
}
