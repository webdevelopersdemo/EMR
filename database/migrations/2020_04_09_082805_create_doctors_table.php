<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_clinic_id');
            $table->foreign('doctor_clinic_id')->references('id')->on('clinics');
            $table->string('doctor_name');
            $table->string('doctor_speciality');
            $table->string('doctor_address');
            $table->bigInteger('doctor_phone');
            $table->float('doctor_fees', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
