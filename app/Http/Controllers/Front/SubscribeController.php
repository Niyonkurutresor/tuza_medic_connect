<?php

namespace App\Http\Controllers\Front;

use App\DataTables\SubscriberDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateSubscribeRequest;
use App\Models\Subscribe;
use DataTables;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SubscribeController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new SubscriberDataTable())->get())->make('true');
        }

        return view('fronts.subscribers.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(CreateSubscribeRequest $request)
    {
        $input = $request->all();
        Subscribe::create([
            'email' => setEmailLowerCase($input['email']),
            'subscribe' => Subscribe::SUBSCRIBE,
        ]);

        return $this->sendSuccess(__('messages.flash.subscriber_creat'));
    }

    /**
     * @return mixed
     */
    public function destroy(Subscribe $subscribe)
    {
        $subscribe->delete();

        return $this->sendSuccess(__('messages.flash.subscriber_delete'));
    }
}
