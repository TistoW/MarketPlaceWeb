<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;

    protected $fillable = [
        'tokoId',
        'name',
        'description',
        'wight', // gram
        'price',
        'stock',
        'images',
        'isActive',
    ];

    protected $casts = [
        'isActive' => 'boolean'
    ];


}
