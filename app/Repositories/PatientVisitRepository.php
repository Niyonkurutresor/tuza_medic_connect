<?php

namespace App\Repositories;

use App\Models\Visit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EncounterRepository
 *
 * @version September 3, 2021, 7:09 am UTC
 */
class PatientVisitRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'visit_date',
        'doctor',
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

    /**
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getShowData($id)
    {
        return Visit::with([
            'visitDoctor.user', 'problems', 'observations', 'notes', 'prescriptions',
        ])->findOrFail($id);
    }
}
