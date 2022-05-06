<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordered_item extends Model
{
    use HasFactory;

    public $fillable = [
        'order_id',
        'item_id',
        'order_details_id',
        'ordered_item_price',
        'ordered_item_qty',
    ];

    public function order_details()
    {
        return $this->belongsTo(Order_detail::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
