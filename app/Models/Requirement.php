<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $fillable = [
        'id_category',
        'requirement_name',
        'stock',
        'price',
        'grand_total',
        'image',

    ];
}
