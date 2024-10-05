<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\State;
use App\Repositories\CityRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class CityController extends AppBaseController
{
    /** @var CityRepository */
    private $cityRepository;

    public function __construct(CityRepository $cityRepo)
    {
        $this->cityRepository = $cityRepo;
    }

    /**
     * Display a listing of the City.
     *
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        $states = State::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('cities.index', compact('states'));
    }

    /**
     * Store a newly created City in storage.
     */
    public function store(CreateCityRequest $request): JsonResponse
    {
        $input = $request->all();

        if (in_array($input['name'], City::CITY_ARRAY)) {
            $city = $this->cityRepository->create($input);
            return $this->sendSuccess(__('messages.flash.city_create'));

        } else {
            return $this->sendError(__('messages.city.city_not_avl'));
        }
    }

    /**
     * Show the form for editing the specified City.
     */
    public function edit(City $city): JsonResponse
    {
        return $this->sendResponse($city, __('messages.flash.city_retrieved'));
    }

    /**
     * Update the specified City in storage.
     */
    public function update(UpdateCityRequest $request, City $city): JsonResponse
    {
        $input = $request->all();
        $this->cityRepository->update($input, $city->id);
        return $this->sendSuccess(__('messages.flash.city_update'));
    }

    public function destroy(City $city): JsonResponse
    {
        $checkRecord = Address::whereCityId($city->id)->exists();

        if ($checkRecord) {
            return $this->sendError(__('messages.flash.city_used'));
        }
        $city->delete();

        return $this->sendSuccess(__('messages.flash.city_delete'));
    }
}
