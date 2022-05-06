<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInOutOfItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_out_of_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->integer('purchased_item_id')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('balance')->nullable();
            $table->timestamps();

            $table->foreign('item_id')
                ->references('id')
                ->on('items')
                ->nullOnDelete();

        //     $table->foreign('purchased_item_id')
        //         ->references('id')
        //         ->on('items')
        //         ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('in_out_of_items');
    }
}
