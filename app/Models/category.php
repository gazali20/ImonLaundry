<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = [
        'name_category',
        'requirement_category',
    ];

    public function services()
    {
        return $this->hasMany(Service::class, 'id_category');
    }


}
