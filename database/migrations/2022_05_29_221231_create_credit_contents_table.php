<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credit_id');
            $table->string('payment_type')->nullable();
            $table->double('payment')->nullable();
            $table->timestamps();

            $table->foreign('credit_id')
                ->references('id')
                ->on('credits')
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
        Schema::dropIfExists('credit_contents');
    }
}
