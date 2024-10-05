<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Review;
use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ReviewController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        $patient = Patient::whereUserId(getLogInUserId())->first();
        $doctorIds = Appointment::wherePatientId($patient['id'])->whereStatus(Appointment::CHECK_OUT)->pluck('doctor_id')->toArray();
        $doctors = Doctor::with('user', 'specializations', 'reviews')
            ->whereIn('id', $doctorIds)
            ->get();
        $logo = Setting::where('key', 'logo')->pluck('value');

        return view('reviews.index', compact('doctors', 'logo'));
    }

    /**
     * @return mixed
     */
    public function store(CreateReviewRequest $request)
    {
        $canReview = Appointment::wherePatientId(getLogInUser()->patient->id)->whereDoctorId($request->doctor_id);
        if (! $canReview->exists()) {
            return $this->sendError(__('messages.common.not_allow__assess_record'));
        }
        $input = $request->all();
        $patient = Patient::whereUserId(getLogInUserId())->first();
        $input['patient_id'] = $patient['id'];
        Review::create($input);
        Notification::create([
            'title' => getLogInUser()->full_name.' just added '.$input['rating'].' star review for you.',
            'type' => Notification::REVIEW,
            'user_id' => Doctor::whereId($input['doctor_id'])->first()->user_id,
        ]);

        return $this->sendSuccess(__('messages.flash.review_add'));
    }

    /**
     * @return mixed
     */
    public function edit(Review $review)
    {
        $canEditReview = Review::whereId($review->id)->wherePatientId(getLogInUser()->patient->id);
        if (! $canEditReview->exists()) {
            return $this->sendError(__('messages.common.not_allow__assess_record'));
        }

        return $this->sendResponse($review, __('messages.flash.review_retrieved'));
    }

    /**
     * @return mixed
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        $data = $request->all();
        $review->update($data);

        return $this->sendSuccess(__('messages.flash.review_edit'));
    }
}
