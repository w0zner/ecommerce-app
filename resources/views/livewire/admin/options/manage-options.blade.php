

<div>
    <div class="flex w-full justify-between">
        <h1 class="font-semibold">
            Opciones
        </h1>
        <x-button custom wire:click="$set('openModal', true)" class="bg-[#2b3440] text-white text-sm px-4 py-2 hover:bg-[#1d232a]">
            <i class="fa-solid fa-plus"></i> Agregar
        </x-button>
    </div>
    <div class="flex justify-center items-start flex-col p-4 pt-1">

        @foreach ($options as $option)
            <div class="card bg-base-100 card-md shadow-sm">
                <div class="card-body">
                    <h2 class="card-title"> {{ $option->name; }}</h2>
                    {{-- <div class="justify-end card-actions">
                        <button class="btn btn-primary">Buy Now</button>
                    </div> --}}
                    <div class="flex">
                        @foreach ($option->features as $feature)
                            @switch($option->type)
                                @case(1)
                                    <div class="badge badge-lg badge-outline rounded-md badge-neutral ml-2">{{$feature->description}}</div>
                                    @break
                                @case(2)
                                    <div class="badge badge-lg badge-outline rounded-md badge-neutral ml-3" style="background-color: {{ $feature->value }}; border: 1px solid #cccccf"></div>
                                    <span class="ml-1">{{$feature->description}}</span>
                                    @break

                                @default

                            @endswitch
                        @endforeach
                    </div>
                    <div class="divider"></div>
                </div>
            </div>
        @endforeach
    </div>

    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            Crear Opción
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <x-label class="mb-1">
                        Nombre
                    </x-label>
                    <x-input class="w-full" wire:model="newOption.name" placeholder="Por ejemplo tamaño, color, etc">
                    </x-input>
                </div>
                <div>
                    <x-label class="mb-1 block text-sm font-medium text-white">
                        Tipo
                    </x-label>
                    <select data-theme="dark" class="bg-[#2b3440]  rounded-lg select select-md select-bordered w-full text-white" wire:model="newOption.type">
                        <option disabled selected value="">Elige una opcion</option>
                        <option value="1">Texto</option>
                        <option value="2">Color</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-center items-center mb-4">
                <h3 class="text-lg font-bold text-white">Valores</h3>
                <div class="divider">
                </div>
            </div>
            @foreach ($newOption['features'] as $index => $feature)
            <div class="p-2 rounded-lg border border-gray-700 mb-1">

                    <div class="grid grid-cols-2 gap-6 mb-4">
                        <div>
                            <x-label class="mb-1">
                                Valor
                            </x-label>
                            <x-input class="w-full" placeholder="Valor" wire:model="newOption.features.{{ $index }}.value">
                            </x-input>
                        </div>
                        <div>
                            <x-label class="mb-1">
                                Descripción
                            </x-label>
                            <x-input class="w-full" placeholder="Descripción" wire:model="newOption.features.{{ $index }}.description">
                            </x-input>
                        </div>

                    </div>
                    @if ($index > 0)
                        <button class="btn btn-sm btn-soft btn-error w-full" type="button" wire:click="removeFeature({{ $index }})">
                            <i class="fa-solid fa-trash text-white"></i>
                        </button>
                    @endif
                {{-- <div class="grid grid-cols-2 gap-6">
                    <div>
                        <x-label class="mb-1">
                            Valor
                        </x-label>
                        <x-input class="w-full" placeholder="Valor">
                        </x-input>
                    </div>
                    <div>
                        <x-label class="mb-1">
                            Descripción
                        </x-label>
                        <x-input class="w-full" placeholder="Descripción">
                        </x-input>
                    </div>
                </div> --}}
            </div>
            @endforeach
            <div class="pt-6 flex justify-end w-full">
                <x-button custom wire:click="addFeature()" class="bg-[#30503c] text-white text-sm px-4 py-2 hover:bg-[#1d232a]">
                    <i class="fa-solid fa-plus"></i>
                </x-button>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button class="btn btn-sm btn-neutral w-full" type="button" wire:click="save()">
                <i class="fa-solid fa-save text-white"></i>
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
