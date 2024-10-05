<?php

namespace App\Http\Controllers;

use Anand\LaravelPaytmWallet\Facades\PaytmWallet;
use App\Http\Requests\CreatePaytmDetailRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Transaction;
use App\Models\User;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

/**
 * Class PayTMController
 */
class PayTMController extends AppBaseController
{
    // display a form for payment
    public function initiate(Request $request): View
    {
        $appointmentId = $request->appointmentId;
        $appointment = Appointment::whereId($appointmentId)->first();
        $doctor = Doctor::with('user')->whereId($appointment->doctor_id)->first();
        $patient = Patient::with('user')->whereId($appointment->patient_id)->first();

        return view('payments.paytm.index', compact('appointmentId', 'appointment', 'doctor', 'patient'));
    }

    /**
     * @return mixed
     */
    public function payment(CreatePaytmDetailRequest $request)
    {
        $input = $request->all();
        $appointmentId = $request->appointmentId;
        $appointment = Appointment::whereId($appointmentId)->first();
        $patient = Patient::with('user')->whereId($appointment->patient_id)->first();
        $payment = PaytmWallet::with('receive');
        $loginUserId = getLogInUser() ? getLogInUserId() : '';

        $payment->prepare([
            'order' => $appointmentId.'|'.$loginUserId.'|'.time(), // 1 should be your any data id
            'user' => $patient['user']['id'], // any user id
            'mobile_number' => $input['mobile'],
            'email' => $input['email'], // your user email address
            'amount' => $appointment->payable_amount, // amount will be paid in INR.
            'callback_url' => route('paytm.callback'), // callback URL
        ]);

        return $payment->receive();  // initiate a new payment
    }

    /**
     * Obtain the payment information.
     *
     * @return object
     */
    public function paymentCallback()
    {
        $transaction = PaytmWallet::with('receive');
        $response = $transaction->response();
        $order_id = $transaction->getOrderId(); // return a order id
        $transaction->getTransactionId(); // return a transaction id
        [$appointmentId, $loginUserId] = explode('|', $order_id);

        // update the db data as per result from api call
        if ($transaction->isSuccessful()) {
            $appointment = Appointment::whereId($appointmentId)->first();
            $patient = Patient::with('user')->whereId($appointment->patient_id)->first();

            $transaction = [
                'user_id' => $patient->user->id,
                'transaction_id' => $response['TXNID'],
                'appointment_id' => $appointment['appointment_unique_id'],
                'amount' => $appointment['payable_amount'],
                'type' => Appointment::PAYTM,
                'meta' => json_encode($response),
            ];

            Transaction::create($transaction);

            $appointment->update([
                'payment_method' => Appointment::PAYTM,
                'payment_type' => Appointment::PAID,
            ]);

            Flash::success(__('messages.flash.appointment_created_payment_complete'));

            Notification::create([
                'title' => Notification::APPOINTMENT_PAYMENT_DONE_PATIENT_MSG,
                'type' => Notification::PAYMENT_DONE,
                'user_id' => $patient->user->id,
            ]);

            if ($loginUserId == User::ADMIN) {
                Auth::loginUsingId($loginUserId);

                return redirect(route('appointments.index'));
            }

            if ($loginUserId != '') {
                Auth::loginUsingId($loginUserId);

                return redirect(route('patients.patient-appointments-index'));
            }

            return redirect(route('medicalAppointment'));
        } elseif ($transaction->isFailed()) {
            Flash::error(__('messages.flash.appointment_created_payment_not_complete'));

            if ($loginUserId == User::ADMIN) {
                Auth::loginUsingId($loginUserId);

                return redirect(route('appointments.index'));
            }

            if ($loginUserId != '') {
                Auth::loginUsingId($loginUserId);

                return redirect(route('patients.patient-appointments-index'));
            }

            return redirect(route('medicalAppointment'));
        } else {
            if ($transaction->isOpen()) {
                Log::info('Open');
            }
        }
        //        $transaction->getResponseMessage(); //Get Response Message If Available
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function failed(): RedirectResponse
    {
        Flash::error(__('messages.flash.appointment_created_payment_not_complete'));

        if (! getLogInUser()) {
            return redirect(route('medicalAppointment'));
        }

        if (getLogInUser()->hasRole('patient')) {
            return redirect(route('patients.patient-appointments-index'));
        }

        return redirect(route('appointments.index'));
    }
}
