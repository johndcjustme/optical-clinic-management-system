<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'frame_photo_path',
        'frame_name',
        'frame_size',
        'frame_qty',
        'frame_desc',
        'item_type',
        'frame_price',
        'supplier_id',
        'created_at',
        'updated_at',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
