<?php

use Illuminate\Database\Seeder;

class MetaDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $metaData = new \App\MetaData();
        $metaData->keywords = "Eindhoven, Klusbedrijf, Loodgieter, Elektra, Renovatie, Snel, Snelle Service, Timmerman, Laminaat, Handyman, Nuenen";
        $metaData->subject = "Klusbedrijf";
        $metaData->description = "";
        $metaData->save();
    }
}
