<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_image',
        'item_name',
        'item_desc',
        'item_qty',
        'item_size',
        'item_type',
        'item_price',
        'supplier_id',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function purchased_item()
    {
        return $this->hasMany(Purchased_item::class);
    }
}
