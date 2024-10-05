<?php

namespace App\Repositories;

use App\Models\Country;

/**
 * Class CountryRepository
 *
 * @version July 29, 2021, 10:49 am UTC
 */
class CountryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'short_code',
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
        return Country::class;
    }
}
