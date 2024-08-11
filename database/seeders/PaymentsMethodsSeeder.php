<?php

namespace Database\Seeders;

use App\Models\V1\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentsMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payment = new PaymentMethod();
        $payment->name = "PIX";
        $payment->commission_percentage = 1.5;
        $payment->save();

        $payment = new PaymentMethod();
        $payment->name = "BOLETO";
        $payment->commission_percentage = 2;
        $payment->save();

        $payment = new PaymentMethod();
        $payment->name = "TRANSFERENCIA";
        $payment->commission_percentage = 4;
        $payment->save();
    }
}
