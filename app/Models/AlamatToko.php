<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class AlamatToko extends Model {
    use HasFactory;

    protected $fillable = [
        'tokoId',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kodepost',
        'provinsiId',
        'kotaId',
        'kecamatanId',
        'phone',
        'email',
        'isActive',
    ];

    protected $casts = [
        'isActive' => 'boolean'
    ];
}
