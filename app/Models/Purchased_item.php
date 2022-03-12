<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchased_item extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'purchase_id',
        'item_id',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    
}
