<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        // 'item_id',
        // 'item_type',
        'qty',
        'total',
        'discount',
        'balance',
        'deposit',
    ];
    
    public function purchased_item()
    {
        return $this->hasMany(Purchased_item::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
