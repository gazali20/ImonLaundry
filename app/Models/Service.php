<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

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

    public function kasirs()
    {
        return $this->belongsToMany(Kasir::class, 'kasir_service')
                    ->withPivot('weight', 'subtotal')
                    ->withTimestamps();
    }
}
