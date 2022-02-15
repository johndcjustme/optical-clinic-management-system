<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('lense_photo_path')->nullable();
            $table->string('lense_name')->nullable();
            $table->string('lense_desc')->nullable();
            $table->integer('lense_qty')->nullable();
            $table->string('lense_tint')->nullable();
            $table->string('item_type')->nullable();
            $table->integer('lense_price')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            // $table->timestamps();

            $table->foreign('supplier_id')
                ->references('id')
                ->on('suppliers')
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
        Schema::dropIfExists('lenses');
    }
}