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
            $table->unsignedBigInteger('patient_admin_id');
            $table->string('role');
            $table->string('post_content');
            $table->datetime('created_at');
            $table->datetime('updated_at');

            $table->foreign('patient_admin_id')
                ->references('id')
                ->on('patients')
                ->onDelete('cascade');
            $table->foreign('patient_admin_id')
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
        Schema::dropIfExists('posts');
    }
}
