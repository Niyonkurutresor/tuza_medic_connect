<?php

namespace App\Repositories;

use App\Models\SmartPatientCards;
use App\Models\Patient;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/**
 * Class StaffRepository
 *
 * @version August 6, 2021, 10:17 am UTC
 */
class GeneratePatientSmartCardsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];


    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }


    public function model()
    {
        return SmartPatientCards::class;
    }

    public function store($input)
    {
        try {
            DB::beginTransaction();

            if($input['status'] == Patient::ALL_PATIENT){
                Patient::where('user_id','!=',null)->update(['template_id' => $input['template_id']]);
                $all = Patient::select('id','patient_unique_id')->get()->pluck('patient_unique_id','id');
                foreach ($all as $key => $value) {
                    Patient::where('id',$key)->update([
                        'qr_code' => route('patient_show').'/'.$value
                    ]);
                }
            }
            if($input['status'] == Patient::ONLY_ONE_PATIENT){
                $data = Patient::where('user_id',$input['patient_id'])->first();
                Patient::where('user_id',$input['patient_id'])->update(['template_id' => $input['template_id']]);
                Patient::where('user_id',$input['patient_id'])->update([
                    'qr_code' => route('patient_show').'/'.$data->patient_unique_id
                ]);
            }
            if($input['status'] == Patient::REMANING_PATIENT){
                $all = Patient::select('id','patient_unique_id')->where('template_id',null)->get()->pluck('patient_unique_id','id');
                foreach ($all as $key => $value) {
                    Patient::where('id',$key)->update([
                        'qr_code' => route('patient_show').'/'.$value
                    ]);
                }
                Patient::where('template_id',null)->update(['template_id' => $input['template_id']]);
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
