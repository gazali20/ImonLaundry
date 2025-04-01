<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $fillable = [
        'id_requirement',
        'date',
        'grand_total',
    ];

    public function requirement()
    {
        return $this->belongsTo(Requirement::class, 'id_requirement');
    }
}
