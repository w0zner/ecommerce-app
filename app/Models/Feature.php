<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
        protected $fillable = [
        'value', 
        'description',
        'option_id'
    ];
    //
    public function Option() {
        return $this->belongsTo(Option::class);
    }

    public function Variants() {
        return $this->belongsToMany(Variant::class)
            ->withTimestamps();
    }
}
