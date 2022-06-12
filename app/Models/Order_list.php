<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_list extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'item_id',
        'qty',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
