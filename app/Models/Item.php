<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // public $itemstamps = false;

    protected $fillable = [
        'category_id',
        'item_image',
        'item_name',
        'item_desc',
        'item_qty',
        'item_size',
        'item_type',
        'item_price',
        'item_buffer',
        'item_cost',
        'supplier_id',
        // 'created_at',
        // 'updated_at',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchased_item()
    {
        return $this->hasMany(Purchased_item::class);
    }

    public function ordered_item()
    {
        return $this->hasMany(Ordered_item::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function in_out()
    {
        return $this->hasMany(In_out_of_item::class);
    }

    public function latestInOut()
    {
        return $this->hasOne(In_out_of_item::class)->latestOfMany();
    }

    public function order_list()
    {
        return $this->hasOne(Order_list::class);
    }
}
