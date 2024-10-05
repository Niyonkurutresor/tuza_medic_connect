<?php

namespace App\Http\Controllers\Front;

use App\DataTables\EnquiryDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateEnquiryRequest;
use App\Mail\EnquiryMails;
use App\Models\Enquiry;
use DataTables;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class EnquiryController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new EnquiryDataTable())->get($request->only('status')))->make('true');
        }
        $status = Enquiry::VIEW_NAME;

        return view('fronts.enquiries.index', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(CreateEnquiryRequest $request)
    {
        try {
            DB::beginTransaction();

            $input = $request->all();
            $input['email'] = setEmailLowerCase($input['email']);
            Enquiry::create($input);
            $input['appName'] = getAppName();

            Mail::to($input['email'])
                ->send(new EnquiryMails('emails.enquiry.enquiry', __('messages.flash.enquire_sent'), $input));

            DB::commit();

            return $this->sendSuccess(__('messages.flash.messages_sent'));
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return Application|Factory|View
     */
    public function show(Enquiry $enquiry): \Illuminate\View\View
    {
        $enquiry->update(['view' => isset($enquiry->view) ?? true]);

        return view('fronts.enquiries.show', compact('enquiry'));
    }

    /**
     * @return mixed
     */
    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();

        return $this->sendSuccess(__('messages.flash.enquire_deleted'));
    }
}
