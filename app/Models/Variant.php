<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{

        protected $fillable = [
        'sku',
        'image_path',
        'product_id'
    ];
    //
    public function Product() {
        return $this->belongsTo(Product::class);
    }

    public function Features() {
        return $this->belongsToMany(Feature::class)
            ->withTimestamps();
    }
}
