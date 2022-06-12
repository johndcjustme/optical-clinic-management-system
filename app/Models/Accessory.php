<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'supplier_id',
        'accessory_photo_path',
        'accessory_name',
        'accessory_desc',
        'accessory_qty',
        'accessory_price',
        'item_type',
        'created_at',
        'updated_at',
    ];
    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
