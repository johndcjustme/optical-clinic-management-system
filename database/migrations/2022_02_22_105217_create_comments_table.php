<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('patient_user_id');
            $table->string('role');
            $table->string('comment_content');
            $table->datetime('created_at');
            $table->datetime('updated_at');

            // $table->foreign('post_id')
            //     ->references('id')
            //     ->on('posts')
            //     ->on('users')
            //     ->on('patients')
            //     ->onDelete('cascade');

            // $table->foreign('patient_user_id')
            //     ->references('id')
            //     ->on('users')
            //     ->onDelete('cascade');

            // $table->foreign('patient_user_id')
            //     ->references('id')
            //     ->on('patients')
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
        Schema::dropIfExists('comments');
    }
}