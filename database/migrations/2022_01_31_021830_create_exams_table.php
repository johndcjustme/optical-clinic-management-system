<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Patient;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('patient_id');
            $table->double('exam_OD_SPH')->nullable();
            $table->double('exam_OD_CYL')->nullable();
            $table->double('exam_OD_AXIS')->nullable();
            $table->double('exam_OD_NVA')->nullable();
            $table->double('exam_OD_PH')->nullable();
            $table->double('exam_OD_SVA')->nullable();
            $table->double('exam_OS_SPH')->nullable();
            $table->double('exam_OS_CYL')->nullable();
            $table->double('exam_OS_AXIS')->nullable();
            $table->double('exam_OS_NVA')->nullable();
            $table->double('exam_OS_PH')->nullable();
            $table->double('exam_OS_SVA')->nullable();
            $table->double('exam_ADD')->nullable();
            $table->double('exam_FRAME')->nullable();
            $table->timestamps();
            $table->foreign('patient_id')
                ->references('id')
                ->on('patients')
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
        Schema::dropIfExists('exams');
    }
}
