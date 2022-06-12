<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'exam_OD_SPH',
        'exam_OD_CYL',
        'exam_OD_AXIS',
        'exam_OD_NVA',
        'exam_OD_PH',
        'exam_OD_CVA',
        'exam_OS_SPH',
        'exam_OS_CYL',
        'exam_OS_AXIS',
        'exam_OS_NVA',
        'exam_OS_PH',
        'exam_OS_CVA',
        'exam_ADD',
        'exam_PD',
        'exam_remarks',
        'exam_frame',
        'exam_lense',
        'exam_tint',
        'exam_others',
    ];

    public function patients()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function order_detail()
    {
        return $this->hasMany(Order_detail::class);
    }
}
