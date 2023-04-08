<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductAttributeValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'attribute_code',
        'value',
        'product_id',
        'attribute_name',
        'label',
    ];
}
