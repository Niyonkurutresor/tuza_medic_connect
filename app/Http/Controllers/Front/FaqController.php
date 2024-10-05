<?php

namespace App\Http\Controllers\Front;

use App\DataTables\FaqDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use App\Models\Faq;
use App\Repositories\FaqRepository;
use Datatables;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class FaqController extends AppBaseController
{
    /** @var FaqRepository */
    private $faqRepository;

    public function __construct(FaqRepository $faqRepo)
    {
        $this->faqRepository = $faqRepo;
    }

    /**
     * Display a listing of the Faq.
     *
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new FaqDataTable())->get())->make(true);
        }

        return view('fronts.faqs.index');
    }

    /**
     * Show the form for creating a new Faq.
     *
     * @return Application|Factory|View
     */
    public function create(): \Illuminate\View\View
    {
        return view('fronts.faqs.create');
    }

    /**
     * Store a newly created Faq in storage.
     *
     * @return Application|Redirector|RedirectResponse
     */
    public function store(CreateFaqRequest $request): RedirectResponse
    {
        $input = $request->all();

        $faq = $this->faqRepository->create($input);

        Flash::success(__('messages.flash.faq_creat'));

        return redirect(route('faqs.index'));
    }

    /**
     * Show the form for editing the specified Faq.
     *
     * @return Application|Factory|View
     */
    public function edit(Faq $faq): \Illuminate\View\View
    {
        return view('fronts.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified Faq in storage.
     *
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UpdateFaqRequest $request, Faq $faq): RedirectResponse
    {
        $faq = $this->faqRepository->update($request->all(), $faq->id);

        Flash::success(__('messages.flash.faq_update'));

        return redirect(route('faqs.index'));
    }

    /**
     * Remove the specified Faq from storage.
     */
    public function destroy(Faq $faq)
    {
        if ($faq->is_default) {
            return $this->sendError(__('messages.flash.appointment_delete'));
        }

        if ($faq->is_default) {
            return $this->sendError(__('messages.flash.faq_use'));
        }

        $faq->delete();

        return $this->sendSuccess(__('messages.flash.faq_delete'));
    }
}
