<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $fillable = [
        'requirement_name',
        'stock',
        'price',
        'category',
        'grand_total',
        'date',
    ];

    public function requirement()
    {
        return $this->belongsTo(Requirement::class, 'id_requirement');
    }
}
