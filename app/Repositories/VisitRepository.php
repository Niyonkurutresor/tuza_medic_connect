<?php

namespace App\Repositories;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Visit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EncounterRepository
 *
 * @version September 3, 2021, 7:09 am UTC
 */
class VisitRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'visit_date',
        'doctor',
        'patient',
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
        return Visit::class;
    }

    public function getData(): array
    {
        $data['doctors'] = Doctor::with('user')->get()->where('user.status', true)->pluck('user.full_name', 'id');
        $data['patients'] = Patient::with('user')->get()->pluck('user.full_name', 'id');

        return $data;
    }

    public function update($input, $encounter): bool
    {
        $encounter->update($input);

        return true;
    }

    /**
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getShowData($id)
    {
        return Visit::with([
            'visitDoctor.user', 'visitPatient.user', 'problems', 'observations', 'notes', 'prescriptions',
        ])->findOrFail($id);
    }
}
