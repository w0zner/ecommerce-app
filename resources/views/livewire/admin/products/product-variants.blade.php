<div>
    <section class="rounded-lg bg-white p-4 shadow-md">
        <header class="border-b border-gray-200 px-6 py-2">
            <div class="flex justify-between">
                <h1>
                    Opciones
                </h1>
                <x-button custom wire:click="$set('openModal', true)" class="bg-[#2b3440] text-white text-sm px-4 py-2 hover:bg-[#1d232a]">
                    <i class="fa-solid fa-plus"></i> Agregar
                </x-button>
            </div>
        </header>
        <div class="p-4">

        </div>
    </section>

    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            Agregar Opción
        </x-slot>
        <x-slot name="content">
            <div class="flex flex-col gap-4">
                <x-label>Opción</x-label>
                <select wire:model="variant.option_id" class="w-full p-2 border border-gray-300 rounded-md">
                    <option value="" disabled>Seleccionar Opción</option>
                    @foreach($options as $option)
                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                    @endforeach
                </select>
                <x-label>Características</x-label>
                <x-input wire:model="variant.features" type="text" />
                <x-button custom wire:click="saveVariant">Guardar</x-button>
                <x-button custom wire:click="$set('openModal', false)">Cancelar</x-button>
            </div>
        </x-slot>
        <x-slot name="footer">

        </x-slot>
    </x-dialog-modal>
</div>
