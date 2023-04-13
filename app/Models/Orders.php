<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    const ORDER_STATUS = [
        0 => 'pending',
        1 => 'processing',
        2 => 'shipping',
        3 => 'complete'
    ];
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'item_qty',
        'item_count',
        'subtotal',
        'status',
        'shipping_address_id',
        'payment_method'
    ];
}
