<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Variant extends Model
{

        protected $fillable = [
        'sku',
        'image_path',
        'stock',
        'product_id'
    ];

    protected function image():Attribute {
        return Attribute::make(
            get: fn() => $this->image_path ? Storage::url($this->image_path) : asset('images/no-product.png')
        );
    }

    public function Product() {
        return $this->belongsTo(Product::class);
    }

    public function Features() {
        return $this->belongsToMany(Feature::class)
            ->withTimestamps();
    }
}
