<?php

namespace App\Livewire\Admin\Options;

use App\Models\Option;
use Livewire\Component;

class ManageOptions extends Component
{

    //Si queremos actualizar options cada vez que se actualice el componente, lo dejamos en el render

    //sacamos del mount porque serializa los datos de la consulta de options y da error de lazy loading,
    //entonces lo dejamos en el render para que se ejecute cada vez que se actualice el componente,
    //y así no da error de lazy loading
    //otra variante seria agregar #[Locked] a la propiedad de options

    //public $options;
    public $openModal=false;

    public $newOption=[
        'name' => '',
        'type' => '',
        'features' => [
            [
                'value' => '',
                'description' => ''
            ]
        ]
    ];

    public function mount() {

    }

    public function addFeature() {
        $this->newOption['features'][] = [
            'value' => '',
            'description' => ''
        ];
    }

    public function removeFeature($index) {
        if($index != 0) {
            unset($this->newOption['features'][$index]);
            $this->newOption['features'] = array_values($this->newOption['features']);
        }
    }

    public function save() {
        $rules = [
            'newOption.name' => 'required',
            'newOption.type' => 'required|in:1,2',
            'newOption.features' => 'required|array|min:1',
        ];

        $this->validate($rules);

        $option = Option::create([
            'name' => $this->newOption['name'],
            'type' => $this->newOption['type']
        ]);

        foreach ($this->newOption['features'] as $feature) {
            $option->features()->create([
                'value' => $feature['value'],
                'description' => $feature['description']
            ]);
        }

        $this->reset('newOption');
        $this->openModal = false;
    }

    public function render()
    {
        return view('livewire.admin.options.manage-options', [
            'options' => Option::with('features')->get()
        ]);
    }
}
