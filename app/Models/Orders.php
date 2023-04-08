<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'item_qty',
        'item_count',
        'subtotal',
        'status',
        'shipping_address_id'
    ];
}
