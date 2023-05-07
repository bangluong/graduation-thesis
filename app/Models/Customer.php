<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'pwd',
        'address_id',
        'dob',
        'name',
        'sdt'
    ];
}
