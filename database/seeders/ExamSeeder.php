<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('exams')->insert([
            'patient_id' => 1,
            'exam_OD_SPH' => '0.12',
            'exam_OD_CYL' => '-0.12',
            'exam_OD_AXIS' => '-0.12',
            'exam_OD_NVA' => '0.12',
            'exam_OD_PH' => '-0.12',
            'exam_OD_SVA' => '-0.12',
            'exam_OS_SPH' => '0.12',
            'exam_OS_CYL' => '-0.12',
            'exam_OS_AXIS' => '-0.12',
            'exam_OS_NVA' => '0.12',
            'exam_OS_PH' => '-0.12',
            'exam_OS_SVA' => '-0.12',
            'exam_ADD' => '-0.12',
            'exam_FRAME' => '-0.12',
        ]);
        DB::table('exams')->insert([
            'patient_id' => 2,
            'exam_OD_SPH' => '0.12',
            'exam_OD_CYL' => '-0.12',
            'exam_OD_AXIS' => '-0.12',
            'exam_OD_NVA' => '0.12',
            'exam_OD_PH' => '-0.12',
            'exam_OD_SVA' => '-0.12',
            'exam_OS_SPH' => '0.12',
            'exam_OS_CYL' => '-0.12',
            'exam_OS_AXIS' => '-0.12',
            'exam_OS_NVA' => '0.12',
            'exam_OS_PH' => '-0.12',
            'exam_OS_SVA' => '-0.12',
            'exam_ADD' => '-0.12',
            'exam_FRAME' => '-0.12',
        ]);
    }
}
