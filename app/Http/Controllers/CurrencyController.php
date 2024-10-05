<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Models\Currency;
use App\Models\Setting;
use App\Repositories\CurrencyRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class CurrencyController extends AppBaseController
{
    /** @var CurrencyRepository */
    private $currencyRepository;

    public function __construct(CurrencyRepository $currencyRepo)
    {
        $this->currencyRepository = $currencyRepo;
    }

    /**
     * Display a listing of the Currency.
     *
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        return view('currencies.index');
    }

    /**
     * Store a newly created Currency in storage.
     */
    public function store(CreateCurrencyRequest $request): JsonResponse
    {

        $input = $request->all();

        $isdata = 0;
        foreach (Currency::CURRENCY_ARRAY as $key => $value) {
            if ($key == $input['currency_code']) {
                $isdata = 1;
            }
        }
        if ($isdata == 1) {
            $this->currencyRepository->store($input);
            return $this->sendSuccess(__('messages.flash.currency_create'));
        } else {
            return $this->sendError(__('messages.currency.currency_not_avl'));
        }

        Cache::flush('currency');
    }

    public function edit(Currency $currency): JsonResponse
    {
        return $this->sendResponse($currency, __('messages.flash.currency_retrieved'));
    }

    /**
     * Update the specified Currency in storage.
     */
    public function update(UpdateCurrencyRequest $request, Currency $currency): JsonResponse
    {

        if ($currency->is_default) {
            return $this->sendError(__('messages.common.error_default_records'));
        }

        $input = $request->all();

        $isdata = 0;
        foreach (Currency::CURRENCY_ARRAY as $key => $value) {
            if ($key == $input['currency_code']) {
                $isdata = 1;
            }
        }
        if ($isdata == 1) {
            $this->currencyRepository->update($input, $currency->id);
            return $this->sendSuccess(__('messages.flash.currency_update'));
        } else {
            return $this->sendError(__('messages.currency.currency_not_avl'));
        }

        Cache::flush('currency');
    }

    /**
     * Remove the specified Currency from storage.
     */
    public function destroy(Currency $currency): JsonResponse
    {
        return $this->sendError(__('messages.common.error_default_records'));

        if ($currency->is_default) {
            return $this->sendError(__('messages.common.error_default_records'));
        }

        $checkRecord = Setting::where('key', 'currency')->first()->value;

        if ($checkRecord == $currency->id) {
            return $this->sendError(__('messages.flash.currency_used'));
        }
        $currency->delete();

        return $this->sendSuccess(__('messages.flash.currency_delete'));
    }
}
