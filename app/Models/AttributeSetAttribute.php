<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AttributeSetAttribute extends Model
{
    protected $fillable = [
        'attribute_set_name',
        'attribute_code'
    ];
    use HasFactory;

    public function deleteIfExist($set, $attr)
    {
        DB::table('attribute_set_attributes')
            ->where('attribute_set_name', '=', $set)
            ->where('attribute_code', '=', $attr)->delete();
    }
    public function getBySet($setName) {
        return DB::table('attribute_set_attributes')
            ->where('attribute_set_name', '=', $setName)->get();
    }
}
