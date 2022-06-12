<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'name', 'desc', 'cvalue', 'cname',
    ];

    public function item()
    {
        $this->hasMany(Item::class, 'category_id', 'id');
    }
}
