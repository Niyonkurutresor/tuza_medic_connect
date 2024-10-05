<?php

namespace App\Repositories;

use App\Models\State;

/**
 * Class StateRepository
 *
 * @version July 29, 2021, 11:48 am UTC
 */
class StateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'country_id',
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
        return State::class;
    }
}
