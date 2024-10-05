<?php

namespace App\Repositories;

use App\Models\SmartPatientCards;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use App\Models\User;

/**
 * Class StaffRepository
 *
 * @version August 6, 2021, 10:17 am UTC
 */
class SmartPatientCardsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'template_name',
        'address',
        'header_color',
        'show_email',
        'show_phone',
        'show_dob',
        'show_blood_group',
        'show_address',
        'show_patient_unique_id',
    ];


    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }


    public function model()
    {
        return SmartPatientCards::class;
    }

    public function store($input): bool
    {
        try {
            DB::beginTransaction();

            $input['show_email'] = isset($input['show_email']) ? 1 : 0;
            $input['show_phone'] = isset($input['show_phone']) ? 1 : 0;
            $input['show_dob'] = isset($input['show_dob']) ? 1 : 0;
            $input['show_blood_group'] = isset($input['show_blood_group']) ? 1 : 0;
            $input['show_address'] = isset($input['show_address']) ? 1 : 0;
            $input['show_patient_unique_id'] = isset($input['show_patient_unique_id']) ? 1 : 0;
            $smartcard = SmartPatientCards::create($input);

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function update($input, $id)
    {
        try {
            DB::beginTransaction();

            $smartcard = SmartPatientCards::find($id);
            $input['show_email'] = isset($input['show_email']) ? 1 : 0;
            $input['show_phone'] = isset($input['show_phone']) ? 1 : 0;
            $input['show_dob'] = isset($input['show_dob']) ? 1 : 0;
            $input['show_blood_group'] = isset($input['show_blood_group']) ? 1 : 0;
            $input['show_address'] = isset($input['show_address']) ? 1 : 0;
            $input['show_patient_unique_id'] = isset($input['show_patient_unique_id']) ? 1 : 0;
            $smartcard->update($input);
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
