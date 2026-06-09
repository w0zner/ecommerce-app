<?php

namespace App\Livewire\Forms\Admin\Options;

use App\Models\Option;
use Livewire\Attributes\Validate;
use Livewire\Form;

class NewOptionForm extends Form
{
    public $name = '';
    public $type = '';
    public $features = [
        [
            'value' => '',
            'description' => ''
        ]
    ];

    public function addFeature() {
        $this->features[] = [
            'value' => '',
            'description' => ''
        ];
    }

    public function removeFeature($index) {
        if($index != 0) {
            unset($this->features[$index]);
            $this->features = array_values($this->features);
        }
    }

    protected $validationAttributes = [
        'features.*.description' => 'descripción de la característica',
        'features.*.value' => 'valor de la característica',
    ];

    public function rules() {
        $rules = [
            'name' => 'required',
            'type' => 'required|in:1,2',
            'features' => 'required|array|min:1',
            'features.*.value' => 'required',
            'features.*.description' => 'required',
        ];

        return $rules;
    }

    public function save() {
        $this->validate();

        $option = Option::create([
            'name' => $this->name,
            'type' => $this->type
        ]);

        foreach ($this->features as $feature) {
            $option->features()->create([
                'value' => $feature['value'],
                'description' => $feature['description']
            ]);
        }

        $this->reset();
        //$this->openModal = false;
    }
}
