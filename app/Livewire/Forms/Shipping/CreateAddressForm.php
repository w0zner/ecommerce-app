<?php

namespace App\Livewire\Forms\Shipping;

use App\Enums\TypeOfDocuments;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateAddressForm extends Form
{
    public $type='2';
    public $description='';
    public $district='';
    public $reference='';
    public $receiver=1;
    public $receiver_info=[];
    public $default=false;

    public function rules() {
        return [
            'type' => 'required|in:1,2',
            'description' => 'required|string',
            'district' => 'required|string',
            'reference' => 'required|string',
            'receiver' => 'required|in:1,2',
            'receiver_info' => 'required|array',
            'receiver_info.name' => 'required|string',
            'receiver_info.document_type' => [
                'required',
                new Enum(TypeOfDocuments::class)
            ],
            'receiver_info.document_number' => 'required|string',
            'receiver_info.phone' => 'required|string',
        ];
    }

    public function validationAttributes() {
        return [
            'type' => 'tipo de dirección',
            'description' => 'descripción',
            'district' => 'ciudad',
            'reference' => 'referencia',
            'receiver' => 'receptor',
            'receiver_info.name' => 'nombre del receptor',
            'receiver_info.document_number' => 'número de documento del receptor',
            'receiver_info.phone' => 'teléfono del receptor',
        ];
    }

    public function save() {

        $user=Auth::user();
        $this->validate();

        if($user->addresses()->count() === 0) {
            $this->default = true;
        }

        Address::create([
            'user_id' => $user->id,
            'type' => $this->type,
            'description' => $this->description,
            'district' => $this->district,
            'reference' => $this->reference,
            'receiver' => $this->receiver,
            'receiver_info' => $this->receiver_info,
            'default' => $this->default
        ]);

        $this->reset();

        $this->receiver_info = [
             'name' => $user->name,
            'last_name' => $user->last_nameme,
            'document_type' => $user->document_type,
            'document_number' => $user->document_number,
            'phone' => $user->phone,
        ];
    }
}
