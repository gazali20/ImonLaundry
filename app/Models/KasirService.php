<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasirService extends Model
{
    use HasFactory;

    protected $table = 'kasir_service';

    protected $fillable = [
        'kasir_id',
        'service_id',
        'weight',
        'subtotal',
    ];

    public function kasir()
    {
        return $this->belongsTo(Kasir::class, 'kasir_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
