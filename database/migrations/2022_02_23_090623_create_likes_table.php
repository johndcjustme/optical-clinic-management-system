<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_comment_id');
            $table->unsignedBigInteger('user_id');
            $table->string('post_type')->nullable(); //post or commment
            // $table->string('role')->nullable();
            // $table->integer('reacted_by_patient_user_id')->nullable();
            // $table->string('reacted_by_role')->nullable();
            // $table->boolean('like_dislike')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('likes');
    }
}
