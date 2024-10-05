<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Repositories\SmartPatientCardsRepository;
use App\Models\SmartPatientCards;
use Flash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Requests\CreateSmartCardTemplateRequest;
use App\Models\Patient;

class SmartPatientCardsController extends AppBaseController
{

    private $SmartPatientCardsRepository;

    public function __construct(SmartPatientCardsRepository $staffRepo)
    {
        $this->SmartPatientCardsRepository = $staffRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('smart_patient_cards.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $qr = QrCode::generate('Make me into a QrCode!');
        $logo = Setting::where('key','logo')->pluck('value');
        $clinic_name = Setting::where('key','clinic_name')->pluck('value')->first();
        $address_one = Setting::where('key','address_one')->pluck('value')->first();
        return view('smart_patient_cards/create',compact('logo','qr','clinic_name','address_one'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSmartCardTemplateRequest $request)
    {
        $input = $request->all();
        $this->SmartPatientCardsRepository->store($input);

        Flash::success(__('messages.smart_patient_card.template_created'));

        if (isRole('doctor')) {
            return redirect(route('doctors.smart-patient-cards.index'));
        }
        if (isRole('clinic_admin')) {
            return redirect(route('smart-patient-cards.index'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $smart_patient_cards = SmartPatientCards::where('id',$id)->first();
        $logo = Setting::where('key','logo')->pluck('value');
        $clinic_name = Setting::where('key','clinic_name')->pluck('value')->first();
        $address_one = Setting::where('key','address_one')->pluck('value')->first();
        return view('smart_patient_cards.edit',compact('smart_patient_cards','logo','clinic_name','address_one'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->SmartPatientCardsRepository->update($request->all(), $id);

        Flash::success(__('messages.smart_patient_card.template_update'));

        if (isRole('doctor')) {
            return redirect(route('doctors.smart-patient-cards.index'));
        }
        if (isRole('clinic_admin')) {
            return redirect(route('smart-patient-cards.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Patient::where('template_id',$id)->update(['template_id'=>null]);
        SmartPatientCards::where('id',$id)->delete();

        return $this->sendSuccess(__('messages.smart_patient_card.template_deleted'));
    }

    public function changeCardStatus(Request $request ,$id) {
        $status = SmartPatientCards::findOrFail($id);
        $status->update([$request->changefield => $request->status]);
        return $this->sendResponse($status, __('messages.smart_patient_card.template_update'));
    }
}
