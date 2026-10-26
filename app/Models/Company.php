<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'whatsapp',
        'address',
        'city',
        'logo',
        'slogan',
    ];

    //Accessor
    //Es una funcion que se llama como un atributo
    //Devuelve una url a partir del path de la logo en el storage
    protected function logo(): Attribute {
        return Attribute::make(
            get: fn () => Storage::url($this->logo)
        );
    }
}
