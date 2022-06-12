<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lense extends Model
{
    use HasFactory;

    public $timestamps = false;

    // const CREATED_AT = null;
    // const UPDATED_AT = null;

    protected $fillable = [
        'supplier_id',
        'lense_photo_path',
        'lense_name',
        'lense_desc',
        'lense_qty',
        'lense_tint',
        'item_type',
        'lense_price',
        'created_at',
        'updated_at',
    ];


    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

}
