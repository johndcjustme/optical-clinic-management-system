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
            $table->string('patient_avatar')->nullable();
            $table->string('patient_fname');
            $table->string('patient_lname');
            $table->string('patient_mname')->nullable();
            $table->string('patient_address')->nullable();
            $table->integer('patient_age')->nullable();
            $table->string('patient_occupation')->nullable();
            $table->string('patient_mobile')->nullable();
            $table->string('patient_email')->nullable();
            $table->string('patient_gender')->nullable();
            $table->string('patient_password')->nullable();
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
