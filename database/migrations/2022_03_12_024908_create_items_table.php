<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('item_image')->nullable();
            $table->string('item_name')->nullable();
            $table->string('item_desc')->nullable();
            $table->integer('item_qty')->nullable();
            $table->string('item_size')->nullable();
            $table->string('item_type')->nullable();
            $table->integer('item_price')->nullable();
            $table->integer('item_cost')->nullable();
            $table->integer('item_buffer')->nullable();
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
        Schema::dropIfExists('items');
    }
}
