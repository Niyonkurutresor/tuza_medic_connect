<?php

namespace App\Repositories;

use App\Models\ServiceCategory;

/**
 * Class ServiceCategoryRepository
 *
 * @version August 2, 2021, 7:11 am UTC
 */
class ServiceCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
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
        return ServiceCategory::class;
    }
}
