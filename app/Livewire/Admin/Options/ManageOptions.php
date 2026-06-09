<?php

namespace App\Livewire\Admin\Options;

use App\Livewire\Forms\Admin\Options\NewOptionForm;
use App\Models\Option;
use Livewire\Component;

class ManageOptions extends Component
{

    //Si queremos actualizar options cada vez que se actualice el componente, lo dejamos en el render

    //sacamos del mount porque serializa los datos de la consulta de options y da error de lazy loading,
    //entonces lo dejamos en el render para que se ejecute cada vez que se actualice el componente,
    //y así no da error de lazy loading
    //otra variante seria agregar #[Locked] a la propiedad de options
    public $openModal=false;

    public NewOptionForm $newOption;

    public function addFeature() {
        $this->newOption->addFeature();
    }

    public function removeFeature($index) {
        $this->newOption->removeFeature($index);
    }

    public function save() {
        $this->newOption->save();
        $this->openModal = false;
    }

    public function render()
    {
        return view('livewire.admin.options.manage-options', [
            'options' => Option::with('features')->get()
        ]);
    }
}
