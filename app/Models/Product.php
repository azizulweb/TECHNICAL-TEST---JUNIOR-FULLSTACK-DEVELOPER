<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Product
 * Bertanggung jawab terhadap data produk/inventaris
 */

class Product extends Model
{
    // Kolom yang boleh diisi melalui mass assignment
    protected $fillable = [
        'name',     
        'stock', 
        'price'
    ];
}

