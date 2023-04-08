<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $fillable = ['title','parent_id'];

    use HasFactory;

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public static function childs($id) {
        return static::query()->where('parent_id', '=', $id)->get();
        //return $this->hasMany('App\Category','parent_id','id');
    }
}
