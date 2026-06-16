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
    public $modo = 'create';

    public NewOptionForm $newOption;

    public function addFeature() {
        $this->newOption->addFeature();
    }

    public function removeFeature($index) {
        $this->newOption->removeFeature($index);
    }

    public function mount(?Option $option = null)
{
    // El signo '?' antes de Option permite que sea null
    // '= null' le da un valor por defecto si no se envía desde el Blade

    if ($option && $option->exists) {
        // MODO EDICIÓN: Si pasaron una opción y existe en la Base de Datos
        $this->newOption->setOption($option);
        $this->openModal = true;
        $this->modo = 'edit';
    } else {
        // MODO CREACIÓN/LISTADO: Si entran normal, nos aseguramos de que empiece limpio
        $this->newOption->reset();
        $this->modo = 'create';
    }
}

    public function save() {
        if($this->modo == 'create') {
            $this->newOption->save();
        } else {
            $this->newOption->update();
        }
        $this->openModal = false;
    }

    public function render()
    {
        return view('livewire.admin.options.manage-options', [
            'options' => Option::with('features')->get()
        ]);
    }
}
