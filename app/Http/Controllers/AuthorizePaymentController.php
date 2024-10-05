<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Transaction;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use PayPalHttp\HttpException;

/**
 * Class AuthorizePaymentController
 */
class AuthorizePaymentController extends AppBaseController
{
    public function onboard(Request $request): View
    {

        $appointmentId = $request->appointmentId;
        $appointment = Appointment::whereId($appointmentId)->first();
        $doctorName = Doctor::with('user')->whereId($appointment->doctor_id)->first();
        $months = getMonth();

        return view('payments.authorize.index', compact('appointment', 'doctorName', 'months'));
    }

    public function pay(Request $request)
    {
        $input = $request->input();
        $currencySupport = authorizedCurrencySupports();
         if ($currencySupport === false) {

            Flash::error(__('messages.payment_method.authorize') . ' ' . __('messages.flash.currency_not_supported'));

            return redirect(route('appointments.index'));
         }
        $appointmentId = $input['appointmentId'];
        $appointment = Appointment::whereId($appointmentId)->first();

        /* Create a merchantAuthenticationType object with authentication details
          retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(config('payments.authorize.login_id'));
        $merchantAuthentication->setTransactionKey(config('payments.authorize.transaction_key'));

        // Set the transaction's refId
        $refId = 'ref'.time();
        $cardNumber = preg_replace('/\s+/', '', $input['cardNumber']);

        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($cardNumber);
        $creditCard->setExpirationDate($input['expiration-year'].'-'.$input['expiration-month']);
        $creditCard->setCardCode($input['cvv']);

        // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create a TransactionRequestType object and add the previous objects to it
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType('authCaptureTransaction');
        $transactionRequestType->setAmount($appointment->payable_amount);
        $transactionRequestType->setPayment($paymentOne);

        // Assemble the complete transaction request
        $requests = new AnetAPI\CreateTransactionRequest();
        $requests->setMerchantAuthentication($merchantAuthentication);
        $requests->setRefId($refId);
        $requests->setTransactionRequest($transactionRequestType);

        // Create the controller and get the response
        $controller = new AnetController\CreateTransactionController($requests);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

        if ($response != null) {
            // Check to see if the API request was successfully received and acted upon
            if ($response->getMessages()->getResultCode() == 'Ok') {
                // Since the API request was successful, look for a transaction response
                // and parse it to display the results of authorizing the card
                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getMessages() != null) {
                    $message_text = $tresponse->getMessages()[0]->getDescription().', Transaction ID: '.$tresponse->getTransId();
                    $msg_type = 'success_msg';

                    try {
                        $patient = Patient::with('user')->whereId($appointment->patient_id)->first();

                        $transaction = [
                            'user_id' => $patient->user->id,
                            'transaction_id' => $tresponse->getTransId(),
                            'appointment_id' => $appointment['appointment_unique_id'],
                            'amount' => intval($appointment['payable_amount']),
                            'type' => Appointment::AUTHORIZE,
                            'meta' => json_encode($tresponse),
                        ];

                        Transaction::create($transaction);

                        $appointment->update([
                            'payment_method' => Appointment::AUTHORIZE,
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
                    } catch (HttpException $ex) {
                        echo $ex->statusCode;
                        print_r($ex->getMessage());
                    }
                } else {
                    $message_text = __('messages.flash.there_were');
                    $msg_type = 'error_msg';

                    if ($tresponse->getErrors() != null) {
                        $message_text = $tresponse->getErrors()[0]->getErrorText();
                        $msg_type = 'error_msg';
                    }
                }
                // Or, print errors if the API request wasn't successful
            } else {
                $message_text = __('messages.flash.there_were');
                $msg_type = 'error_msg';

                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getErrors() != null) {
                    $message_text = $tresponse->getErrors()[0]->getErrorText();
                    $msg_type = 'error_msg';
                } else {
                    $message_text = $response->getMessages()->getMessage()[0]->getText();
                    $msg_type = 'error_msg';
                }
            }
        } else {
            $message_text = __('messages.no_response');
            $msg_type = 'error_msg';
        }

        return back()->with($msg_type, $message_text);
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
