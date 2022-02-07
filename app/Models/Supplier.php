<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_name',
        'supplier_contact_no',
        'supplier_address',
        'supplier_bank',
        'supplier_acc_no',
        'supplier_branch',
    ];
}
