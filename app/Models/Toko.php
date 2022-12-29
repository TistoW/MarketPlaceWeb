<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Toko extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'userId',
        'alamatId',
        'kota',
        'image'
    ];

    public function address(): HasOne {
        return $this->hasOne(AlamatToko::class, "tokoId", "id");
    }
}
