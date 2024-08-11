<?php

namespace Database\Seeders;

use App\Models\V1\IdentificationDocument;
use Illuminate\Database\Seeder;

class IdentificationDocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $document = new IdentificationDocument();
        $document->name = "INE";
        $document->save();

        $document = new IdentificationDocument();
        $document->name = "CURP";
        $document->save();

        $document = new IdentificationDocument();
        $document->name = "PASAPORTE";
        $document->save();
    }
}
