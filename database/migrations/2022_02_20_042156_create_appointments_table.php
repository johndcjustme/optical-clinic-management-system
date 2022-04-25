<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('appointment_category_id')->nullable();
            $table->string('appt_date')->nullable();
            $table->string('appt_time')->nullable();
            $table->string('appt_resched')->nullable();
            $table->string('appt_status')->nullable();
            $table->boolean('appt_confirmed')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->foreign('patient_id')
                ->references('id')
                ->on('patients')
                ->onDelete('cascade');

            $table->foreign('appointment_category_id')
                ->references('id')
                ->on('appointment_categories')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
