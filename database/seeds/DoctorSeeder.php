<?php

use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctors')->insert([
        	[
	            'doctor_clinic_id' => 1,
	            'doctor_name' => 'Manish Thakur',
	            'doctor_speciality' => 'ENT Specialist',
	            'doctor_address' => 'Shastri nagar',
	            'doctor_phone'  => "9517538529",
	            'doctor_fees'  => 800,
	            'created_at' => date('y-m-d H:i:s'),
	            'updated_at' => date('y-m-d H:i:s')
        	],
        	[
	            'doctor_clinic_id' => 1,
	            'doctor_name' => 'Ketan Bakshi',
	            'doctor_speciality' => 'Liver Specialist',
	            'doctor_address' => 'Jalandhar Cantt',
	            'doctor_phone'  => "8529638525",
	            'doctor_fees'  => 400,
	            'created_at' => date('y-m-d H:i:s'),
	            'updated_at' => date('y-m-d H:i:s')
        	],
        	[
	            'doctor_clinic_id' => 2,
	            'doctor_name' => 'Amit Verma',
	            'doctor_speciality' => 'Liver Specialist',
	            'doctor_address' => 'patiala',
	            'doctor_phone'  => "8745896587",
	            'doctor_fees'  => 700,
	            'created_at' => date('y-m-d H:i:s'),
	            'updated_at' => date('y-m-d H:i:s')
        	],
        	[
	            'doctor_clinic_id' => 2,
	            'doctor_name' => 'Gurbaksh Singh',
	            'doctor_speciality' => 'Bones Specialist',
	            'doctor_address' => 'Mumbai',
	            'doctor_phone'  => "5252565895",
	            'doctor_fees'  => 1000,
	            'created_at' => date('y-m-d H:i:s'),
	            'updated_at' => date('y-m-d H:i:s')
        	],
        	[
	            'doctor_clinic_id' => 3,
	            'doctor_name' => 'Kriti Sharma',
	            'doctor_speciality' => 'Throat Specialist',
	            'doctor_address' => 'Mohali',
	            'doctor_phone'  => "8529638525",
	            'doctor_fees'  => 400,
	            'created_at' => date('y-m-d H:i:s'),
	            'updated_at' => date('y-m-d H:i:s')
        	],
        	[
	            'doctor_clinic_id' => 3,
	            'doctor_name' => 'Sanjeeta Thapar',
	            'doctor_speciality' => 'nerve Specialist',
	            'doctor_address' => 'Hmachal Pradesh',
	            'doctor_phone'  => "8529638525",
	            'doctor_fees'  => 1500,
	            'created_at' => date('y-m-d H:i:s'),
	            'updated_at' => date('y-m-d H:i:s')
        	]
    	]);
    }
}
