<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_user_id');
            $table->string('role')->nullable();
            $table->string('post_content');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            // $table->foreign('patient_user_id')
            //     ->references('id')
            //     ->on('patients')
            //     ->on('users')
            //     ->onDelete('cascade');

            // $table->foreign('patient_user_id')
            //     ->references('id')
            //     ->on('users')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
