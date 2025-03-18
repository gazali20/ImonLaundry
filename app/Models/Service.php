<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = 
    [
        'id_category',
        'name_service',
        'price',
        'code',
        'image',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }
}
