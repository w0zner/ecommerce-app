<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
        protected $fillable = [
        'name',
        'type'
    ];
    //
    public function products() {
        return $this->belongsToMany(Product::class)
            ->withPivot('feature_value')
            ->withTimestamps();
    }

    public function features() {
        return $this->hasMany(Feature::class);
    }
}
