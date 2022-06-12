<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            
            $table->id();

            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('exam_id');

            $table->string('order_code')->nullable();
            $table->integer('order_status')->nullable();
            $table->string('order_desc')->nullable();
            
            $table->string('frames')->nullable();
            $table->string('lense')->nullable();
            $table->string('tint')->nullable();
            $table->string('others')->nullable();

            $table->double('total')->nullable();
            $table->double('discount')->nullable();
            $table->double('balance')->nullable();
            $table->double('deposit')->nullable();
            $table->dateTime('duedate')->nullable();
            
            $table->timestamps();

            $table->foreign('patient_id')
                ->references('id')
                ->on('patients')
                ->onDelete('cascade');

            $table->foreign('exam_id')
                ->references('id')
                ->on('exams')
                ->onDelete('cascade');

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
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
        Schema::dropIfExists('order_details');
    }
}
