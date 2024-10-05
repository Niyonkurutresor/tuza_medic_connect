<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Medicine;
use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends AppBaseController
{
    /** @var CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Category.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index(): View
    {
        $data['statusArr'] = Category::STATUS_ARR;

        return view('categories.index', $data);
    }

    /**
     * Store a newly created Category in storage.
     */
    public function store(CreateCategoryRequest $request): JsonResponse
    {
        $input = $request->all();
        $input['is_active'] = ! isset($input['is_active']) ? false : true;
        $this->categoryRepository->create($input);

        return $this->sendSuccess(__('messages.medicine.medicine_category').' '.__('messages.medicine.saved_successfully'));
    }

    /**
     * @return Factory|View
     */
    public function show(Category $category): View
    {
        $medicines = $category->medicines;

        return view('categories.show', compact('medicines', 'category'));
    }

    /**
     * Show the form for editing the specified Category.
     */
    public function edit(Category $category): JsonResponse
    {
        return $this->sendResponse($category, __('messages.medicine.category_retrieved_successfully'));
    }

    /**
     * Update the specified Category in storage.
     */
    public function update(Category $category, UpdateCategoryRequest $request): JsonResponse
    {
        $input = $request->all();
        $input['is_active'] = ! isset($input['is_active']) ? false : true;
        $this->categoryRepository->update($input, $category->id);

        return $this->sendSuccess(__('messages.medicine.medicine_category').' '.__('messages.medicine.updated_successfully'));
    }

    /**
     * Remove the specified Category from storage.
     *
     *
     * @throws Exception
     */
    public function destroy(Category $category): JsonResponse
    {
        $medicineCategoryModel = [
            Medicine::class,
        ];
        $result = canDelete($medicineCategoryModel, 'category_id', $category->id);
        if ($result) {
            return $this->sendError(__('messages.medicine.medicine_category').' '.__('messages.medicine.cant_be_deleted'));
        }
        $this->categoryRepository->delete($category->id);

        return $this->sendSuccess(__('messages.medicine.medicine_category').' '.__('messages.medicine.deleted_successfully'));
    }

    public function activeDeActiveCategory(int $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $category->is_active = ! $category->is_active;
        $category->save();

        return $this->sendSuccess(__('messages.medicine.status_updated_successfully'));
    }
}
