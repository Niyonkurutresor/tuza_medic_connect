<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Transaction;
use App\Models\User;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaystackController extends Controller
{
    /**
     * @return mixed
     */
    public function redirectToGateway(Request $request)
    {
         $currencySupport = paystackCurrencySupports();

         if ($currencySupport === false) {
            Flash::error(__('messages.payment_method.paystack') . ' ' . __('messages.flash.currency_not_supported'));

            return redirect(route('appointments.index'));
         }

        $appointmentId = $request['appointmentData'];
        $appointment = Appointment::whereId($appointmentId)->first();
        $patientEmail = Patient::with('user')->whereId($appointment['patient_id'])->first();
        $appointmentUniqueId = $appointment['appointment_unique_id'];

        try {
            $request->merge([
                'email' => $patientEmail->user->email, // email of recipients
                'orderID' => $appointmentUniqueId, // anything
                'amount' => $appointment['payable_amount'] * 100,
                'quantity' => 1, // always 1
                'currency' => getCurrencyCode(),
                'reference' => Paystack::genTranxRef(),
                'metadata' => json_encode(['appointmentId' => $appointmentId]), // this should be related data
            ]);
            return Paystack::getAuthorizationUrl()->redirectNow();
        } catch (\Exception $e) {
            return Redirect::back()->withMessage([
                'msg' => __('messages.flash.paystack_token_expired'),
                'type' => 'error',
            ]);
        }
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function handleGatewayCallback(Request $request): RedirectResponse
    {
        $paymentDetails = Paystack::getPaymentData();

        $appointmentId = $paymentDetails['data']['metadata']['appointmentId'];
        $appointment = Appointment::whereId($appointmentId)->first();
        $patientId = User::whereEmail($paymentDetails['data']['customer']['email'])->pluck('id')->first();

        $transaction = [
            'user_id' => $patientId,
            'transaction_id' => $paymentDetails['data']['reference'],
            'appointment_id' => $appointment['appointment_unique_id'],
            'amount' => intval($appointment['payable_amount']),
            'type' => Appointment::PAYSTACK,
            'meta' => json_encode($paymentDetails['data']),
        ];

        Transaction::create($transaction);

        $appointment->update([
            'payment_method' => Appointment::PAYSTACK,
            'payment_type' => Appointment::PAID,
        ]);

        Flash::success(__('messages.flash.appointment_created_payment_complete'));

        $patient = Patient::whereUserId($patientId)->with('user')->first();

        Notification::create([
            'title' => Notification::APPOINTMENT_PAYMENT_DONE_PATIENT_MSG,
            'type' => Notification::PAYMENT_DONE,
            'user_id' => $patient->user_id,
        ]);

        if (parse_url(url()->previous(), PHP_URL_PATH) == '/medical-appointment') {
            return redirect(route('medicalAppointment'));
        }

        if (! getLogInUser()) {
            return redirect(route('medical'));
        }

        if (getLogInUser()->hasRole('patient')) {
            return redirect(route('patients.patient-appointments-index'));
        }

        return redirect(route('appointments.index'));
    }
}
