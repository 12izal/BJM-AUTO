<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'nama',
        'slug',
        'merk',
        'model',
        'tahun',
        'jenis_kendaraan',
        'transmisi',
        'bahan_bakar',
        'warna',
        'kilometer',
        'plat_nomor',
        'harga',
        'deskripsi',
        'status'
    ];

    // TAMBAHKAN DI SINI
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

}