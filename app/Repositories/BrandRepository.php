<?php

namespace App\Repositories;

use App\Models\Brand;

/**
 * Class BrandRepository
 *
 * @version February 13, 2020, 4:28 am UTC
 */
class BrandRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'seller',
        'email',
        'phone',
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
        return Brand::class;
    }
}
