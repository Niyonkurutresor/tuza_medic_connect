<?php

namespace App\Repositories;

use App\Http\Controllers\AppBaseController;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\ServiceCategory;
use DB;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class ServicesRepository
 *
 * @version August 2, 2021, 12:09 pm UTC
 */
class ServicesRepository extends AppBaseController
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'category_id',
        'name',
        'charges',
        'doctors',
        'status',
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
        return Service::class;
    }

    public function store(array $input): bool
    {
        try {
            DB::beginTransaction();

            $input['charges'] = str_replace(',', '', $input['charges']);
            $input['status'] = (isset($input['status'])) ? 1 : 0;
            $services = Service::create($input);
            if (isset($input['doctors']) && ! empty($input['doctors'])) {
                $services->serviceDoctors()->sync($input['doctors']);
            }
            if (isset($input['icon']) && ! empty('icon')) {
                $services->addMedia($input['icon'])->toMediaCollection(Service::ICON, config('app.media_disc'));
            }
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function update($input, $service): bool
    {
        try {
            DB::beginTransaction();
            $input['charges'] = str_replace(',', '', $input['charges']);
            $input['status'] = (isset($input['status'])) ? 1 : 0;
            $service->update($input);
            $service->serviceDoctors()->sync($input['doctors']);

            if (isset($input['icon']) && ! empty('icon')) {
                $service->clearMediaCollection(Service::ICON);
                $service->media()->delete();
                $service->addMedia($input['icon'])->toMediaCollection(Service::ICON, config('app.media_disc'));
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function prepareData(): array
    {
        $data['serviceCategories'] = ServiceCategory::orderBy('name', 'ASC')->pluck('name', 'id');
        $data['doctors'] = Doctor::with('user')->get()->where('user.status', true)->pluck('user.full_name', 'id');

        return $data;
    }
}
