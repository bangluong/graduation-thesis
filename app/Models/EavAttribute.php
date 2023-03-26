<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EavAttribute extends Model
{
    protected $fillable = [
        'name',
        'attribute_code',
        'type'
    ];
    use HasFactory;
}
