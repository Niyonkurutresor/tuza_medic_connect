<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\PaymentGateway;
use Illuminate\Database\Seeder;

class DefaultPaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentGateways = [
            [
                'payment_gateway_id' => Appointment::MANUALLY,
                'payment_gateway' => Appointment::PAYMENT_METHOD[1],
            ], 
            [
                'payment_gateway_id' => Appointment::MOMO,
                'payment_gateway' => Appointment::PAYMENT_METHOD[8],
            ],
            
        ];

        foreach ($paymentGateways as $paymentGateway) {
            PaymentGateway::create($paymentGateway);
        }
    }
}
