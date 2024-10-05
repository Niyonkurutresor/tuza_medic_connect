<?php

namespace App\Repositories;

use App\Models\Slider;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class StaffRepository
 *
 * @version September 21, 2021, 11:40 am UTC
 */
class SliderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'short_description',
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
        return Slider::class;
    }

    public function store($input): bool
    {
        try {
            DB::beginTransaction();

            $slider = slider::create($input);

            if (isset($input['image']) && ! empty($input['image'])) {
                $slider->addMedia($input['image'])->toMediaCollection(Slider::SLIDER_IMAGE, config('app.media_disc'));
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function update($input, $id): bool
    {
        try {
            DB::beginTransaction();

            $slider = slider::findOrFail($id);
            $slider->update($input);

            if (isset($input['image']) && ! empty($input['image'])) {
                $slider->clearMediaCollection(Slider::SLIDER_IMAGE);
                $slider->media()->delete();
                $slider->addMedia($input['image'])->toMediaCollection(Slider::SLIDER_IMAGE, config('app.media_disc'));
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
