<?php

namespace App\Repositories;

use App;
use App\Models\Doctor;
use App\Models\LiveConsultation;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\UserZoomCredential;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class LiveConsultationRepository
 */
class LiveConsultationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'doctor_id',
        'patient_id',
        'consultation_title',
        'consultation_date',
        'consultation_duration_minutes',
        'type',
        'type_number',
        'description',
    ];

    /**
     * Return searchable fields
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return LiveConsultation::class;
    }

    public function getTypeNumber($input): Collection
    {
    }

    /**
     * @throws BindingResolutionException
     */
    public function store(array $input): bool
    {
        /** @var ZoomRepository $zoomRepo */
        $zoomRepo = App::make(ZoomRepository::class);

        try {
            $input['created_by'] = getLogInUserId();
            $startTime = $input['consultation_date'];
            $input['consultation_date'] = Carbon::parse($startTime)->format('Y-m-d H:i:s');
            $zoom = $zoomRepo->createZoomMeeting($input);
            $input['password'] = $zoom['password'];
            $input['meeting_id'] = $zoom['id'];
            $input['meta'] = $zoom;
            $input['status'] = LiveConsultation::STATUS_AWAITED;

            $zoomModel = LiveConsultation::create($input);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function edit(array $input, LiveConsultation $liveConsultation): bool
    {
        /** @var ZoomRepository $zoomRepo */
        $zoomRepo = App::make(ZoomRepository::class, ['createdBy' => $liveConsultation->created_by]);

        try {
            // $zoomRepo->update($liveConsultation->meeting_id, $input); needs to be updated
            $zoomSessionUpdate = $zoomRepo->updateZoomMeeting($input, $liveConsultation);
            // $zoom = $zoomRepo->zoomGet($liveConsultation->meeting_id, ['meeting_owner' => $liveConsultation->created_by]);
            // $input['password'] = $zoom['data']['password'];
            // $input['meta'] = $zoom['data'];
            $input['created_by'] = getLogInUserId();
            $input['created_by'] = $liveConsultation->created_by != getLogInUserId() ? $liveConsultation->created_by : getLogInUserId();
            $startTime = $input['consultation_date'];
            $input['consultation_date'] = Carbon::parse($startTime)->format('Y-m-d H:i:s');

            $zoomModel = $liveConsultation->update($input);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function createUserZoom(array $input)
    {
        try {
            UserZoomCredential::updateOrCreate([
                'user_id' => getLogInUserId(),
            ], [
                'user_id' => getLogInUserId(),
                'zoom_api_key' => $input['zoom_api_key'],
                'zoom_api_secret' => $input['zoom_api_secret'],
            ]);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function createNotification(array $input = [])
    {
        try {
            $patient = Patient::with('user')->where('id', $input['patient_id'])->first();
            $doctor = Doctor::with('user')->where('id', $input['doctor_id'])->first();

            $patientNotification = Notification::create([
                'title' => 'Your live consultation has been created by '.$doctor->user->full_name.'.',
                'type' => Notification::LIVE_CONSULTATION,
                'user_id' => $patient->user->id,
            ]);

            $doctorNotification = Notification::create([
                'title' => $patient->user->full_name.' live consultation has been booked.',
                'type' => Notification::LIVE_CONSULTATION,
                'user_id' => $doctor->user->id,
            ]);
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
