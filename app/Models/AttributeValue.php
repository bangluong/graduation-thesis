<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AttributeValue extends Model
{
    protected $fillable = [
        'value',
        'attribute_code',
        'swatch'
    ];
    use HasFactory;

    public static function getValueOptionOfAttribute($attrCode)
    {
        return DB::table('attribute_values')->where('attribute_code', '=', $attrCode)->get();
    }

    public static function deleteByAttribute($attrCode)
    {
        DB::table('attribute_values')->where('attribute_code', '=', $attrCode)->delete();
    }
}
