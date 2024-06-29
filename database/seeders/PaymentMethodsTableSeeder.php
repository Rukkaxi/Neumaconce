<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentMethods = [
            'WebPay'
        ];

        foreach ($paymentMethods as $paymentMethod) {
            PaymentMethod::create(['name' => $paymentMethod]);
        }
    }
}
