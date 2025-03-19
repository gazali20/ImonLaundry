<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    protected $fillable = [
        'name_category',
    ];

    public function requirement()
    {
        return $this->hasMany(Requirement::class, 'id_need');
    }
}
