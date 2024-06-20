<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    // public function productImageGalleries()
    // {
    //     return $this->hasMany(ProductImageGallery::class);
    // }
}
