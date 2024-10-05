<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVisitPrescriptionRequest;
use App\Http\Requests\CreateVisitRequest;
use App\Http\Requests\UpdateVisitRequest;
use App\Models\Visit;
use App\Models\VisitNote;
use App\Models\VisitObservation;
use App\Models\VisitPrescription;
use App\Models\VisitProblem;
use App\Repositories\VisitRepository;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class VisitController extends AppBaseController
{
    /** @var VisitRepository */
    private $visitRepository;

    public function __construct(VisitRepository $visitRepo)
    {
        $this->visitRepository = $visitRepo;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        return view('visits.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): \Illuminate\View\View
    {
        $data = $this->visitRepository->getData();

        return view('visits.create', compact('data'));
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateVisitRequest $request): RedirectResponse
    {
        $input = $request->all();
        $this->visitRepository->create($input);

        Flash::success(__('messages.flash.visit_create'));

        if (getLoginUser()->hasRole('doctor')) {
            return redirect(route('doctors.visits.index'));
        }

        return redirect(route('visits.index'));
    }

    /**
     * @return Application|Factory|View|RedirectResponse
     */
    public function show($id)
    {
        if (getLogInUser()->hasRole('doctor')) {
            $doctor = Visit::whereId($id)->whereDoctorId(getLogInUser()->doctor->id);
            if (! $doctor->exists()) {
                return redirect()->back();
            }
        }

        $visit = $this->visitRepository->getShowData($id);

        return view('visits.show', compact('visit'));
    }

    /**
     * @return Application|Factory|View
     */
    public function edit(Visit $visit)
    {
        if (getLogInUser()->hasRole('doctor')) {
            $doctor = Visit::whereId($visit->id)->whereDoctorId(getLogInUser()->doctor->id);
            if (! $doctor->exists()) {
                return redirect(route('doctors.visits.index'));
            }
        }

        $data = $this->visitRepository->getData();

        return view('visits.edit', compact('data', 'visit'));
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Visit $visit, UpdateVisitRequest $request): RedirectResponse
    {
        $input = $request->all();
        $visit->update($input);

        Flash::success(__('messages.flash.visit_update'));

        if (getLoginUser()->hasRole('doctor')) {
            return redirect(route('doctors.visits.index'));
        }

        return redirect(route('visits.index'));
    }

    public function destroy(Visit $visit): mixed
    {
        if (getLogInUser()->hasrole('doctor')) {
            if ($visit->doctor_id !== getLogInUser()->doctor->id) {
                return $this->sendError(__('messages.common.not_allow__assess_record'));
            }
        }
        $visit->delete();

        return $this->sendSuccess(__('messages.flash.visit_delete'));
    }

    /**
     * @return mixed
     */
    public function addProblem(Request $request)
    {
        $input = $request->all();
        $problem = VisitProblem::create(['problem_name' => $input['problem_name'], 'visit_id' => $input['visit_id']]);
        $problemData = VisitProblem::whereVisitId($input['visit_id'])->get();

        return $this->sendResponse($problemData, __('messages.flash.problem_added'));
    }

    /**
     * @return mixed
     */
    public function deleteProblem($id)
    {
        $problem = VisitProblem::findOrFail($id);
        $visitId = $problem->visit_id;
        $problem->delete();
        $problemData = VisitProblem::whereVisitId($visitId)->get();

        return $this->sendResponse($problemData, __('messages.flash.problem_delete'));
    }

    /**
     * @return mixed
     */
    public function addObservation(Request $request)
    {
        $input = $request->all();
        $observation = VisitObservation::create([
            'observation_name' => $input['observation_name'], 'visit_id' => $input['visit_id'],
        ]);
        $observationData = VisitObservation::whereVisitId($input['visit_id'])->get();

        return $this->sendResponse($observationData, __('messages.flash.observation_added'));
    }

    /**
     * @return mixed
     */
    public function deleteObservation($id)
    {
        $observation = VisitObservation::findOrFail($id);
        $visitId = $observation->visit_id;
        $observation->delete();
        $observationData = VisitObservation::whereVisitId($visitId)->get();

        return $this->sendResponse($observationData, __('messages.flash.observation_delete'));
    }

    /**
     * @return mixed
     */
    public function addNote(Request $request)
    {
        $input = $request->all();
        $note = VisitNote::create(['note_name' => $input['note_name'], 'visit_id' => $input['visit_id']]);
        $noteData = VisitNote::whereVisitId($input['visit_id'])->get();

        return $this->sendResponse($noteData, __('messages.flash.note_added'));
    }

    /**
     * @return mixed
     */
    public function deleteNote($id)
    {
        $note = VisitNote::findOrFail($id);
        $visitId = $note->visit_id;
        $note->delete();
        $noteData = VisitNote::whereVisitId($visitId)->get();

        return $this->sendResponse($noteData, __('messages.flash.note_delete'));
    }

    /**
     * @return mixed
     */
    public function addPrescription(CreateVisitPrescriptionRequest $request)
    {
        $input = $request->all();
        if (! empty($input['prescription_id'])) {
            $prescription = VisitPrescription::findOrFail($input['prescription_id']);
            $prescription->update($input);
            $message = __('messages.flash.visit_prescription_update');
        } else {
            VisitPrescription::create($input);
            $message = __('messages.flash.visit_prescription_added');
        }

        $visitPrescriptions = VisitPrescription::whereVisitId($input['visit_id'])->get();

        return $this->sendResponse($visitPrescriptions, $message);
    }

    /**
     * @return mixed
     */
    public function editPrescription($id)
    {
        $prescription = VisitPrescription::findOrFail($id);

        return $this->sendResponse($prescription, __('messages.flash.prescription_retrieved'));
    }

    /**
     * @return mixed
     */
    public function deletePrescription($id)
    {
        $prescription = VisitPrescription::findOrFail($id);
        $visitId = $prescription->visit_id;
        $prescription->delete();
        $prescriptionData = VisitPrescription::whereVisitId($visitId)->get();

        return $this->sendResponse($prescriptionData, __('messages.flash.prescription_delete'));
    }
}
