<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AttributeSet extends Model
{
    protected $fillable = [
        'attribute_set_name',
    ];
    use HasFactory;
}
