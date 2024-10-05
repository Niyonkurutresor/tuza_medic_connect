<?php

namespace App\Http\Controllers\Front;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Slider;
use App\Repositories\SliderRepository;
use Datatables;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class SliderController extends AppBaseController
{
    /** @var SliderRepository */
    private $sliderRepository;

    public function __construct(SliderRepository $sliderRepo)
    {
        $this->sliderRepository = $sliderRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new SliderDataTable)->get())->make('true');
        }

        return view('fronts.sliders.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Application|Factory|View
     */
    public function edit(Slider $banner): \Illuminate\View\View
    {
        return view('fronts.sliders.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateSliderRequest $request, Slider $banner): RedirectResponse
    {
        $input = $request->all();
        $banner = $this->sliderRepository->update($input, $banner->id);

        Flash::success(__('messages.flash.slider_update'));

        return redirect(route('banner.index'));
    }
}
