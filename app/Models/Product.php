<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'sku',
        'name',
        'description',
        'image_path',
        'price',
        'subcategory_id'
    ];
    //
    public function Subcategory() {
         return $this->belongsTo(Subcategory::class);
    }

    public function Variants() {
        return $this->hasMany(Variant::class);
    }

    public function options() {
        return $this->belongsToMany(Option::class)  
            ->withPivot('feature_value')
            ->withTimestamps();
    }
}
