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
        'ordered_item_price',
        'ordered_item_qty',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
