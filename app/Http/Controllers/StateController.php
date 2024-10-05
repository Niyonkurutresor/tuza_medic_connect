<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStateRequest;
use App\Http\Requests\UpdateStateRequest;
use App\Models\Address;
use App\Models\Country;
use App\Models\State;
use App\Repositories\StateRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class StateController extends AppBaseController
{
    /** @var StateRepository */
    private $stateRepository;

    public function __construct(StateRepository $stateRepo)
    {
        $this->stateRepository = $stateRepo;
    }

    /**
     * Display a listing of the State.
     *
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        $countries = Country::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('states.index', compact('countries'));
    }

    /**
     * Store a newly created State in storage.
     */
    public function store(CreateStateRequest $request): JsonResponse
    {
        $input = $request->all();
        $country = Country::where('id', $input['country_id'])->pluck('name')->first();

        $isdata = 0;
        foreach (State::STATE_ARRAY as $key => $value) {
            if ($value == $country) {
                $isdata = 1;
            }
        }
        if ($isdata == 1) {
            $state = $this->stateRepository->create($input);
            return $this->sendSuccess(__('messages.flash.state_create'));
        } else {
            return $this->sendError(__('messages.common.state_not_avl'));
        }
    }

    /**
     * Show the form for editing the specified State.
     */
    public function edit(State $state): JsonResponse
    {
        return $this->sendResponse($state, __('messages.flash.states_retrieve'));
    }

    /**
     * Update the specified State in storage.
     */
    public function update(UpdateStateRequest $request, State $state): JsonResponse
    {
        $input = $request->all();
        $this->stateRepository->update($input, $state->id);
        return $this->sendSuccess(__('messages.flash.state_update'));
    }

    public function destroy(State $state): JsonResponse
    {
        $checkRecord = Address::whereStateId($state->id)->exists();
        if ($checkRecord) {
            return $this->sendError(__('messages.flash.state_use'));
        }

        $state->delete();

        return $this->sendSuccess(__('messages.flash.state_delete'));
    }
}
