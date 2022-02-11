<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lense extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'lense_photo_path',
        'lense_name',
        'lense_desc',
        'lense_qty',
        'lense_tint',
        'lense_type',
        'lense_price',
    ];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

}
