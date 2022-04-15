<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->string('order_code')->nullable();
            $table->integer('order_status')->nullable();
            $table->string('order_desc')->nullable();
            
            $table->double('total')->nullable();
            $table->double('discount')->nullable();
            $table->double('balance')->nullable();
            $table->double('deposit')->nullable();
            $table->dateTime('duedate')->nullable();

            $table->dateTime('received_at')->nullable();
            $table->dateTime('claimed_at')->nullable();
            $table->timestamps();

            $table->foreign('patient_id')
                ->references('id')
                ->on('patients')
                ->onDelete('cascade');
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
