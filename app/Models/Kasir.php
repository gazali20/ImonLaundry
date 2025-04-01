<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer',
        'no_handphone',
        'payment',
        'grand_total',
        'status',
        'date',
        'code_invoice',
    ];

    // Relasi ke layanan melalui tabel pivot
    public function services()
    {
        return $this->belongsToMany(Service::class, 'kasir_service')
                    ->withPivot('weight', 'subtotal')
                    ->withTimestamps();
    }
    public function kasirService()
    {
        return $this->hasMany(KasirService::class, 'kasir_id');
    }

}
