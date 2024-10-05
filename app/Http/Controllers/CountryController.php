<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Address;
use App\Models\Country;
use App\Repositories\CountryRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class CountryController extends AppBaseController
{
    /** @var CountryRepository */
    private $countryRepository;

    public function __construct(CountryRepository $countryRepo)
    {
        $this->countryRepository = $countryRepo;
    }

    /**
     * Display a listing of the Country.
     *
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        return view('countries.index');
    }

    /**
     * Store a newly created Country in storage.
     */
    public function store(CreateCountryRequest $request): JsonResponse
    {
        $input = $request->all();
        $input['short_code'] = strtoupper($input['short_code']);

        $isdata = 0;
        foreach (Country::COUNTRY_ARRAY as $key => $value) {
            if ($value == $input['short_code']) {
                $isdata = 1;
            }
        }
        if ($isdata == 1) {
            $country = $this->countryRepository->create($input);
            return $this->sendSuccess(__('messages.flash.country_create'));
        } else {
            return $this->sendError(__('messages.country.country_not_avl'));
        }
    }

    /**
     * Show the form for editing the specified Country.
     */
    public function edit(Country $country): JsonResponse
    {
        return $this->sendResponse($country, __('messages.flash.Country_retrieved'));
    }

    /**
     * Update the specified Country in storage.
     */
    public function update(UpdateCountryRequest $request, Country $country): JsonResponse
    {
        $input = $request->all();
        $this->countryRepository->update($input, $country->id);
        return $this->sendSuccess(__('messages.flash.country_update'));
    }

    public function destroy(Country $country): JsonResponse
    {
        $checkRecord = Address::whereCountryId($country->id)->exists();
        if ($checkRecord) {
            return $this->sendError(__('messages.flash.country_used'));
        }

        $country->delete();

        return $this->sendSuccess(__('messages.flash.country_delete'));
    }
}
