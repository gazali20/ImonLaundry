<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $fillable = [
        'id_need',
        'requirement_name',
        'stock',
        'price',
        'grand_total',
        'image',

    ];

    public function need()
    {
        return $this->belongsTo(Need::class, 'id_need');
    }
}
