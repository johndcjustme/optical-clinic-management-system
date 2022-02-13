<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFramesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frames', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('frame_photo_path')->nullable();
            $table->string('frame_name')->nullable();
            $table->string('frame_size')->nullable();
            $table->integer('frame_qty')->nullable();
            $table->string('frame_desc')->nullable();
            $table->string('item_type')->nullable();
            $table->integer('frame_price')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

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
        Schema::dropIfExists('frames');
    }
}
