<?php

namespace App\Livewire\Forms\Shipping;

use App\Enums\TypeOfDocuments;
use App\Models\Address;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditAddressForm extends Form
{
    public $id=null;
    public $type='2';
    public $description='';
    public $district='';
    public $reference='';
    public $receiver=1;
    public $receiver_info=[];
    public $default=false;

    public function rules() {
        return [
            'id' => 'required|integer|exists:addresses,id',
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

    public function edit(Address $address) {
        $this->id = $address->id;
        $this->type = $address->type;
        $this->description = $address->description;
        $this->district = $address->district;
        $this->reference = $address->reference;
        $this->receiver = $address->receiver;
        $this->receiver_info = $address->receiver_info;
        $this->default = $address->default;
    }

    public function update() {
        $this->validate();
        $address=Address::find($this->id);
        $address->update([
            'type' => $this->type,
            'description' => $this->description,
            'district' => $this->district,
            'reference' => $this->reference,
            'receiver' => $this->receiver,
            'receiver_info' => $this->receiver_info,
            'default' => $this->default,
        ]);
        $this->reset();
    }
}
