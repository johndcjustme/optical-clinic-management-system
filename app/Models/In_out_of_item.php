<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class In_out_of_item extends Model
{
    use HasFactory;

    public $fillable = [
        'item_id',
        'purchased_item_id',
        'status',
        'qty',
        'balance',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
