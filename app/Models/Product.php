<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'sku',
        'name',
        'description',
        'image_path',
        'price',
        'stock',
        'subcategory_id'
    ];

    protected function image(): Attribute {
        return Attribute::make(
            get: fn() => Storage::url($this->image_path)
        );
    }

    public function subcategory() {
         return $this->belongsTo(Subcategory::class);
    }

    public function variants() {
        return $this->hasMany(Variant::class);
    }

    public function options() {
        return $this->belongsToMany(Option::class)
            ->using(OptionProduct::class)
            ->withPivot('features')
            ->withTimestamps();
    }

    public function scopeVerifyFamily($query, $family_id) {
        $query->when($family_id, function($query) use ($family_id) {
            $query->whereHas('subcategory.category', function($query) use ($family_id) {
                $query->where('family_id', $family_id);
            });
        });
    }

    public function scopeVerifyCategory($query, $category_id) {
        $query->when($category_id, function($query) use($category_id) {
            $query->whereHas('subcategory', function($query) use($category_id){
                $query->where('category_id', $category_id);
            });
        });
    }

    public function scopeVerifySubcategory($query, $subcategory_id) {
        $query->when($subcategory_id, function($query) use($subcategory_id) {
                $query->where('subcategory_id', $subcategory_id);
        });
    }


}
