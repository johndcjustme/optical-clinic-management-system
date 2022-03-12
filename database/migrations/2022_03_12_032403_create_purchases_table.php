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
            $table->integer('total')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('balance')->nullable();
            $table->integer('deposit')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->foreign('patient_id')
                ->references('id')
                ->on('patients')
                ->nullOnDelete();
            $table->foreign('item_id')
                ->references('id')
                ->on('items')
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
