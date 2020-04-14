<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_clinic_id');
            $table->integer('patient_doctor_id');
            $table->foreign('patient_clinic_id')->references('id')->on('clinics');
            $table->foreign('patient_doctor_id')->references('id')->on('doctors');
            $table->string('name');
            $table->string('email')->unique();
            $table->bigInteger('mobile');
            $table->string('state');
            $table->string('country');
            $table->string('address');
            $table->string('occupation');
            $table->enum('status', [0, 1])->default(1);
            $table->string('image')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
