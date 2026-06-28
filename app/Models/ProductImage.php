<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{

    protected $fillable = [
        'product_id',
        'gambar',
        'is_cover',
        'urutan'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}