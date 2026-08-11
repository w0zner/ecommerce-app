<?php

namespace App\Models;

use App\Observers\CoverObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[ObservedBy(CoverObserver::class)]
class Cover extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image_path',
        'start_at',
        'end_at',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    //Accessor
    //Es una funcion que se llama como un atributo
    //Devuelve una url a partir del path de la imagen en el storage
    protected function image(): Attribute {
        return Attribute::make(
            get: fn () => Storage::url($this->image_path)
        );
    }
}
