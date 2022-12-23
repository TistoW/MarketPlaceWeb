<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'categoryId',
    ];

    protected $casts = [
        'isActive' => 'boolean'
    ];

    public function category(): HasOne {
        return $this->hasOne(Category::class, "id", "categoryId");
    }

}
