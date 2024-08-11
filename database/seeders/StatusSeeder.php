<?php

namespace Database\Seeders;

use App\Models\V1\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $status = new Status();
        $status->name = "PENDIENTE";
        $status->save();

        $status = new Status();
        $status->name = "PAGADO";
        $status->save();

        $status = new Status();
        $status->name = "TRANFERENCIA BANCARIA";
        $status->save();
    }
}
