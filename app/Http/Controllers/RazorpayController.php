<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Transaction;
use Auth;
use Exception;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

class RazorpayController extends AppBaseController
{
    public function onBoard(Request $request): \Illuminate\Http\JsonResponse
    {

         if (!env('RAZOR_KEY') || !env('RAZOR_SECRET')) {
               return $this->sendError(__('messages.payment_method.razorpay') . ' ' . __('messages.razorpay.credentials_not_set'));
         }

         $currencySupport = razorpayCurrencySupports();
         if ($currencySupport === false) {
            return response()->json(['message' => __('messages.payment_method.razorpay') . ' ' . __('messages.flash.currency_not_supported'), 'status' => false]);
         }

        $appointmentID = $request->appointmentId;
        $appointment = Appointment::whereId($appointmentID)->first();
        $patient = Patient::with('user')->whereId($appointment->patient_id)->first();

        $amount = $appointment->payable_amount;
        $api = new Api(config('payments.razorpay.key'), config('payments.razorpay.secret'));
        $orderData = [
            'receipt' => '1',
            'amount' => $amount * 100, // 100 = 1 rupees
            'currency' => getCurrencyCode(),
            'notes' => [
                'email' => $patient->user->email,
                'name' => $patient->user->full_name,
                'appointmentID' => $appointmentID,
            ],
        ];
        $razorpayOrder = $api->order->create($orderData);
        $data['id'] = $razorpayOrder->id;
        $data['amount'] = $amount;
        $data['name'] = $patient->user->full_name;
        $data['email'] = $patient->user->email;
        $data['contact'] = $patient->user->contact;

        return $this->sendResponse($data, __('messages.flash.order_create'));
    }

    public function paymentSuccess(Request $request)
    {
        $input = $request->all();
        Log::info('RazorPay Payment Successfully');
        Log::info($input);
        $api = new Api(config('payments.razorpay.key'), config('payments.razorpay.secret'));
        if (count($input) && ! empty($input['razorpay_payment_id'])) {
            try {
                $payment = $api->payment->fetch($input['razorpay_payment_id']);
                $generatedSignature = hash_hmac('sha256', $payment['order_id'].'|'.$input['razorpay_payment_id'],
                    config('payments.razorpay.secret'));
                if ($generatedSignature != $input['razorpay_signature']) {
                    return redirect()->back();
                }
                // Create Transaction Here

                $appointmentID = $payment['notes']['appointmentID'];
                $appointment = Appointment::whereId($appointmentID)->first();
                $patient = Patient::with('user')->whereId($appointment->patient_id)->first();

                $transaction = [
                    'user_id' => $patient->user->id,
                    'transaction_id' => $payment->id,
                    'appointment_id' => $appointment['appointment_unique_id'],
                    'amount' => intval($appointment['payable_amount']),
                    'type' => Appointment::RAZORPAY,
                    'meta' => $payment->toArray(),
                ];

                Transaction::create($transaction);

                $appointment->update([
                    'payment_method' => Appointment::RAZORPAY,
                    'payment_type' => Appointment::PAID,
                ]);

                Flash::success(__('messages.flash.appointment_created_payment_complete'));

                Notification::create([
                    'title' => Notification::APPOINTMENT_PAYMENT_DONE_PATIENT_MSG,
                    'type' => Notification::PAYMENT_DONE,
                    'user_id' => $patient->user->id,
                ]);

                if (! getLogInUser()) {
                    return redirect(route('medicalAppointment'));
                }

                if (getLogInUser()->hasRole('patient')) {
                    return redirect(route('patients.patient-appointments-index'));
                }

                return redirect(route('appointments.index'));
            } catch (Exception $e) {
                return false;
            }
        }

        return redirect()->back();
    }

    public function paymentFailed(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->get('data');
        Log::info('payment failed');
        Log::info($data);
        $user = Auth::user();
        $error = $data['error'];
        if (isset($error['metadata']['order_id'])) {
            // failed transactions here
        }

        Flash::error(__('messages.flash.appointment_created_payment_not_complete'));

        if (! getLogInUser()) {
            return redirect(route('medicalAppointment'));
        }

        if (getLogInUser()->hasRole('patient')) {
            return redirect(route('patients.patient-appointments-index'));
        }

        return redirect(route('appointments.index'));
    }

    public function paymentSuccessWebHook(Request $request): bool
    {
        $input = $request->all();
        Log::info('webHook Razorpay');
        Log::info($input);
        if (isset($input['event']) && $input['event'] == 'payment.captured' && isset($input['payload']['payment']['entity'])) {
            $payment = $input['payload']['payment']['entity'];
            // success response
        }

        return false;
    }
}
