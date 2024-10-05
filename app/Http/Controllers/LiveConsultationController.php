<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\CreateZoomCredentialRequest;
use App\Http\Requests\LiveConsultationRequest;
use App\Models\Doctor;
use App\Models\LiveConsultation;
use App\Models\Patient;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserZoomCredential;
use App\Repositories\LiveConsultationRepository;
use App\Repositories\ZoomRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App as FacadesApp;
use Laracasts\Flash\Flash;

class LiveConsultationController extends AppBaseController
{
    /** @var LiveConsultationRepository */
    /** @var ZoomRepository */
    private $liveConsultationRepository;

    private $zoomRepository;

    /**
     * LiveConsultationController constructor.
     */
    public function __construct(
        LiveConsultationRepository $liveConsultationRepository,
        ZoomRepository $zoomRepository
    ) {
        $this->liveConsultationRepository = $liveConsultationRepository;
        $this->zoomRepository = $zoomRepository;
    }

    /**
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function index(): \Illuminate\View\View
    {
        $doctors = Doctor::with('user')->get()->where('user.status', '=', User::ACTIVE)->pluck(
            'user.full_name',
            'id'
        )->sort();
        $patients = Patient::with('user')->get()->where('user.status', '=', User::ACTIVE)->pluck(
            'user.full_name',
            'id'
        )->sort();
        $type = LiveConsultation::STATUS_TYPE;
        $status = LiveConsultation::status;
        $logo = Setting::where('key', 'logo')->pluck('value');

        return view('live_consultations.index', compact('doctors', 'patients', 'type', 'status', 'logo'));
    }

    public function store(LiveConsultationRequest $request): JsonResponse
    {
        try {
            $this->liveConsultationRepository->store($request->all());

            $this->liveConsultationRepository->createNotification($request->all());

            return $this->sendSuccess(__('messages.flash.live_consultation_save'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function show(LiveConsultation $liveConsultation): Factory|View|JsonResponse|Application
    {
        if (getLogInUser()->hasrole('patient')) {
            if ($liveConsultation->patient_id !== getLogInUser()->patient->id) {
                return $this->sendError(__('messages.common.not_allow__assess_record'));
            }
        }
        if (getLogInUser()->hasrole('doctor')) {
            if ($liveConsultation->doctor_id !== getLogInUser()->doctor->id) {
                return $this->sendError(__('messages.common.not_allow__assess_record'));
            }
        }
        $data['liveConsultation'] = LiveConsultation::with([
            'user', 'patient.user', 'doctor.user',
        ])->find($liveConsultation->id);

        return $this->sendResponse($data, __('messages.flash.live_consultation_retrieved'));
    }

    public function edit(LiveConsultation $liveConsultation): JsonResponse
    {
        if (getLogInUser()->hasrole('doctor')) {
            if ($liveConsultation->doctor_id !== getLogInUser()->doctor->id) {
                return $this->sendError(__('messages.common.not_allow__assess_record'));
            }
        }

        return $this->sendResponse($liveConsultation, __('messages.flash.live_consultation_retrieved'));
    }

    public function update(LiveConsultationRequest $request, LiveConsultation $liveConsultation): JsonResponse
    {
        try {
            $this->liveConsultationRepository->edit($request->all(), $liveConsultation);

            return $this->sendSuccess(__('messages.flash.live_consultation_update'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function destroy(LiveConsultation $liveConsultation): JsonResponse
    {
        if (getLogInUser()->hasrole('doctor')) {
            if ($liveConsultation->doctor_id !== getLogInUser()->doctor->id) {
                return $this->sendError(__('messages.common.not_allow__assess_record'));
            }
        }
        try {
            $this->zoomRepository->destroyZoomMeeting($liveConsultation->meeting_id);
            $liveConsultation->delete();

            return $this->sendSuccess(__('messages.flash.live_consultation_delete'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function getChangeStatus(Request $request): JsonResponse
    {
        $liveConsultation = LiveConsultation::findOrFail($request->get('id'));
        $status = null;

        if ($request->get('statusId') == LiveConsultation::STATUS_AWAITED) {
            $status = LiveConsultation::STATUS_AWAITED;
        } elseif ($request->get('statusId') == LiveConsultation::STATUS_CANCELLED) {
            $status = LiveConsultation::STATUS_CANCELLED;
        } else {
            $status = LiveConsultation::STATUS_FINISHED;
        }

        $liveConsultation->update([
            'status' => $status,
        ]);

        return $this->sendsuccess(__('messages.flash.status_change'));
    }

    public function getLiveStatus(LiveConsultation $liveConsultation)
    {
        if (getLogInUser()->hasrole('patient')) {
            if ($liveConsultation->patient_id !== getLogInUser()->patient->id) {
                return $this->sendError(__('messages.common.not_allow__assess_record'));
            }
        }
        if (getLogInUser()->hasrole('doctor')) {
            if ($liveConsultation->doctor_id !== getLogInUser()->doctor->id) {
                return $this->sendError(__('messages.common.not_allow__assess_record'));
            }
        }
        $data['liveConsultation'] = LiveConsultation::with('user')->find($liveConsultation->id);
        /** @var ZoomRepository $zoomRepo */
        $zoomRepo = App::make(ZoomRepository::class, ['createdBy' => $liveConsultation->created_by]);

        $data['zoomLiveData'] = $zoomRepo->zoomGet(
            $liveConsultation->meeting_id
        );

        return $this->sendResponse($data, __('messages.live_status_retrieved_successfully'));
    }

    public function zoomCallback(Request $request): RedirectResponse
    {
        /** $zoomRepo Zoom */
        $zoomRepo = FacadesApp::make(ZoomRepository::class);
        $connected = $zoomRepo->connectWithZoom($request->get('code'));
        if ($connected) {

            Flash::success(__('messages.common.connected_zoom'));

            return redirect(route('doctors.live-consultations.index'));
        }

        return redirect(route('doctors.live-consultations.index'));
    }

    public function zoomCredential(int $id): JsonResponse
    {
        try {
            $data = UserZoomCredential::where('user_id', $id)->first();

            return $this->sendResponse($data, __('messages.flash.user_zoom_credential_retrieved'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function zoomCredentialCreate(CreateZoomCredentialRequest $request): JsonResponse
    {
        try {

            $this->liveConsultationRepository->createUserZoom($request->all());

            return $this->sendSuccess(__('messages.flash.user_zoom_credential_saved'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * [Description for connectWithZoom]
     *
     * @return [type]
     */
    public function connectWithZoom(Request $request): RedirectResponse
    {

        $userZoomCredential = UserZoomCredential::where('user_id', getLogInUserId())->first();

        if ($userZoomCredential == null) {

            return redirect()->back()->withErrors(__('messages.common.zoom_credentials'));
        }

        $clientID = $userZoomCredential->zoom_api_key;
        $callbackURL = config('app.zoom_callback');
        $url = "https://zoom.us/oauth/authorize?client_id=$clientID&response_type=code&redirect_uri=$callbackURL";

        return redirect($url);
    }
}
