<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('accessory_photo_path')->nullable();
            $table->string('accessory_name')->nullable();
            $table->string('accessory_desc')->nullable();
            $table->string('accessory_qty')->nullable();
            $table->string('accessory_price')->nullable();
            $table->string('item_type')->nullable();
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
        Schema::dropIfExists('accessories');
    }
}
