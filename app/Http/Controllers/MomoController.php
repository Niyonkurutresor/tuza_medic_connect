<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Paypack\Paypack;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Notification;



class MomoController extends Controller
{
    //
    public function Momo (Request $request){
        $inputs = $request->all();

        $paypack = new  Paypack();

        $paypack->config([
          'client_id' => env('PAYPACK_CLIENT_ID'),
          'client_secret' => env('PAYPACK_CLIENT_SECRET'),
        ]);


        // check user info
        $appointment = Appointment::whereId(1)->first();
        $patient = Patient::with('user')->whereId($appointment->patient_id)->first();

        // payment
        $cashin = $paypack->Cashin([
            'phone' => $inputs['phone'],
            'amount' => $appointment->payable_amount
        ]);
        // end of configuration 


        /////////////// SUCCESS PAYMENT
        $appointment->update([
            'payment_method' => Appointment::MOMO,
            'payment_type' => Appointment::PAID,
        ]);
        Notification::create([
            'title' => Notification::APPOINTMENT_PAYMENT_DONE_PATIENT_MSG,
            'type' => Notification::PAYMENT_DONE,
            'user_id' => $patient->user->id,
        ]);
        ////////////////END FO SUCCESS PAYMENT 

        $valid = $request->validate( [
            'phone'=>'string|required'
        ]);
        return response()->json(
            [
                'message'=> ' There si payment heated.',
                'cachin'=>$cashin,
                'payment amount'=>$appointment->payable_amount,
                'patient'=>$patient,
                'appointiment'=>$appointment
            ]
            );
    }

    // public function check(){
    //     $paypack = new  Paypack();

    //     $paypack->config([
    //       'client_id' => env('PAYPACK_CLIENT_ID'),
    //       'client_secret' => env('PAYPACK_CLIENT_SECRET'),
    //     ]);
    //     // $transaction = $paypack->Transaction({transaction_ref});
    //     $value = "8c601bfa-00c5-4bda-a377-bbfc05137986"
    //     $transaction = $paypack->Transaction({$value});

    // }
}
