<?php

namespace App\Repositories;

use App\Models\Country;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Illuminate\Support\Facades\Session;
use App\Models\Setting;

/**
 * Class PatientRepository
 *
 * @version July 29, 2021, 11:37 am UTC
 */
class PatientRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

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
        return Patient::class;
    }

    public function getData(): array
    {
        $data['patientUniqueId'] = mb_strtoupper(Patient::generatePatientUniqueId());
        $data['countries'] = Country::toBase()->pluck('name', 'id');
        $data['bloodGroupList'] = Patient::BLOOD_GROUP_ARRAY;

        return $data;
    }

    public function store($input): bool
    {
        try {
            DB::beginTransaction();
            $addressInputArray = Arr::only($input,
                ['address1', 'address2', 'city_id', 'state_id', 'country_id', 'postal_code']);
            $input['patient_unique_id'] = Str::upper($input['patient_unique_id']);
            $input['email'] = setEmailLowerCase($input['email']);
            $patientArray = Arr::only($input, ['patient_unique_id']);
            $input['type'] = User::PATIENT;
            $input['language'] = Setting::where('key','language')->get()->toArray()[0]['value'];
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);

            $patient = $user->patient()->create($patientArray);
            $address = $patient->address()->create($addressInputArray);
            $user->assignRole('patient');
            if (isset($input['profile']) && ! empty($input['profile'])) {
                $patient->addMedia($input['profile'])->toMediaCollection(Patient::PROFILE, config('app.media_disc'));
            }
            $user->sendEmailVerificationNotification();

            DB::commit();

            return true;
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function update($input, $patient): bool
    {
        try {
            DB::beginTransaction();

            $addressInputArray = Arr::only($input,
                ['address1', 'address2', 'city_id', 'state_id', 'country_id', 'postal_code']);
            $input['type'] = User::PATIENT;
            $input['email'] = setEmailLowerCase($input['email']);
            /** @var Patient $patient */
            $patient->user()->update(Arr::except($input, [
                'address1', 'address2', 'city_id', 'state_id', 'country_id', 'postal_code', 'patient_unique_id',
                'avatar_remove',
                'profile', 'is_edit', 'edit_patient_country_id', 'edit_patient_state_id', 'edit_patient_city_id',
                'backgroundImg',
            ]));

            if(isset($patient->address)){
                $patient->address()->update($addressInputArray);
            }else{
                $patient->address()->create($addressInputArray);
            }

            if (isset($input['profile']) && ! empty($input['profile'])) {
                $patient->clearMediaCollection(Patient::PROFILE);
                $patient->media()->delete();
                $patient->addMedia($input['profile'])->toMediaCollection(Patient::PROFILE, config('app.media_disc'));
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function getPatientData($input)
    {
        $patient = Patient::with(['user.address', 'appointments', 'address'])->findOrFail($input['id']);

        return $patient;
    }
}
