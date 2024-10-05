<?php

namespace App\Http\Controllers;

use App\Models\ClinicSchedule;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClinicScheduleController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        $clinicSchedules = ClinicSchedule::all();

        return view('clinic_schedule.index', compact('clinicSchedules'));
    }

    /**
     * Store a newly created ClinicSchedule in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
        if (isset($input['checked_week_days'])) {
            $oldWeekDays = ClinicSchedule::pluck('day_of_week')->toArray();
            foreach (array_diff($oldWeekDays, $input['checked_week_days']) as $dayOfWeek) {
                ClinicSchedule::whereDayOfWeek($dayOfWeek)->delete();
                DB::table('session_week_days')->where('day_of_week', $dayOfWeek)->delete();
            }

            foreach ($input['checked_week_days'] as $day) {
                $startTime = $input['clinicStartTimes'][$day];
                $endTime = $input['clinicEndTimes'][$day];
                if (strtotime($startTime) > strtotime($endTime)) {
                    return $this->sendError(ClinicSchedule::WEEKDAY[$day].__('messages.start_time_invalid'));
                }
                ClinicSchedule::updateOrCreate(['day_of_week' => $day],
                    ['start_time' => $startTime, 'end_time' => $endTime]);
            }

            return $this->sendSuccess(__('messages.flash.clinic_save'));
        }

        ClinicSchedule::query()->delete();
        DB::table('session_week_days')->delete();

        return $this->sendSuccess(__('messages.flash.clinic_save'));
    }

    /**
     * Store a newly created ClinicSchedule in storage.
     */
    public function checkRecord(Request $request): JsonResponse
    {
        $input = $request->all();
        $message = __('messages.flash.some_doctors');
        if (isset($input['checked_week_days'])) {
            $unCheckedDay = array_diff(array_keys(ClinicSchedule::WEEKDAY), $input['checked_week_days']);
            $checkDayOfWeek = DB::table('session_week_days')->whereIn('day_of_week', $unCheckedDay)->exists();

            if ($checkDayOfWeek) {
                return $this->sendError($message);
            } else {
                return $this->sendSuccess('');
            }
        }

        $checkDayOfWeek = DB::table('session_week_days')->exists();
        if ($checkDayOfWeek) {
            return $this->sendError($message);
        }

        return $this->sendResponse('checkDayOfWeek', __('messages.flash.data_retrieve'));
    }

    /**
     * Remove the specified ClinicSchedule from storage.
     */
    public function destroy(ClinicSchedule $clinicSchedule): JsonResponse
    {
        $clinicSchedule->delete();

        return $this->sendSuccess(__('messages.flash.clinic_delete'));
    }
}
