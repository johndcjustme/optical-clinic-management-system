<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_types', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('desc')->nullable();
            $table->double('start_bal')->nullable();
            $table->double('end_bal')->nullable();
            $table->integer('in')->nullable();
            $table->integer('out')->nullable();

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_types');
    }
}
