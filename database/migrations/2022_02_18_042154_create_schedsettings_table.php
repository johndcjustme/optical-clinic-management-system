<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedsettings', function (Blueprint $table) {
            $table->id();
            $table->string('schedset_type')->nullable();
            $table->string('schedset_name')->nullable();
            $table->string('schedset_am_from')->nullable();
            $table->string('schedset_am_to')->nullable();
            $table->string('schedset_pm_from')->nullable();
            $table->string('schedset_pm_to')->nullable();
            $table->boolean('schedset_checked')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedsettings');
    }
}
