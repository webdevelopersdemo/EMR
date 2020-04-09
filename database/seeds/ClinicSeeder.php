<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clinics')->insert([[
            'clinic_name' => 'Care Medical Clinic',
            'clinic_place' => 'Chandigarh',
            'clinic_address' => 'Sector 116',
            'clinic_type' => 'ENT',
            'clinic_description'  => "Welcome to demo text",
            'created_at' => date('y-m-d H:i:s'),
            'updated_at' => date('y-m-d H:i:s')
        ],[
            'clinic_name' => 'Max hosital',
            'clinic_place' => 'Chandigarh1',
            'clinic_address' => 'Sector 1161',
            'clinic_type' => 'ENT1',
            'clinic_description'  => "Welcome to demo text",
            'created_at' => date('y-m-d H:i:s'),
            'updated_at' => date('y-m-d H:i:s')
        ],[
            'clinic_name' => 'fortis',
            'clinic_place' => 'Chandigarh2',
            'clinic_address' => 'Sector 1162',
            'clinic_type' => 'ENT2',
            'clinic_description'  => "Welcome to demo text",
            'created_at' => date('y-m-d H:i:s'),
            'updated_at' => date('y-m-d H:i:s')
        ],[
            'clinic_name' => 'ivy Hospital',
            'clinic_place' => 'Chandigarh3',
            'clinic_address' => 'Sector 1163',
            'clinic_type' => 'ENT3',
            'clinic_description'  => "Welcome to demo text",
            'created_at' => date('y-m-d H:i:s'),
            'updated_at' => date('y-m-d H:i:s')
        ],[
            'clinic_name' => 'Hargun hospital',
            'clinic_place' => 'Chandigarh5',
            'clinic_address' => 'Sector 1165',
            'clinic_type' => 'ENT6',
            'clinic_description'  => "Welcome to demo text",
            'created_at' => date('y-m-d H:i:s'),
            'updated_at' => date('y-m-d H:i:s')
        ]]);
    }
}
