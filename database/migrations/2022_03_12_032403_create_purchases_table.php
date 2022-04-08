<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable();
            // $table->unsignedBigInteger('item_id')->nullable();
            // $table->string('item_type')->nullable();
            $table->integer('qty')->nullable();
            $table->double('total')->nullable();
            $table->double('discount')->nullable();
            $table->double('balance')->nullable();
            $table->double('deposit')->nullable();
            $table->dateTime('duedate')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->foreign('patient_id')
                ->references('id')
                ->on('patients')
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
        Schema::dropIfExists('purchases');
    }
}
