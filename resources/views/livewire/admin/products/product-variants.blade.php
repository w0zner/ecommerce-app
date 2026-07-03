<div>
    <section class="rounded-lg bg-white p-4 shadow-md mb-12">
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
            <div class="space-y-6">
                @if($product->options->isEmpty())
                    <div role="alert" class="alert">
                        <i class="fa-solid fa-info-circle"></i>
                        <span>No hay opciones agregadas al producto.</span>
                    </div>
                @endif
                @foreach($product->options as $option)
                    <div class="bg-gray-50 border border-gray-200 p-2 rounded-md relative p-6" wire:key="product-option-{{ $option->id }}">
                        <div class="absolute -top-3 px-4 bg-white">
                            <button wire:click="deleteOption({{ $option->id }})" class="mr-2">
                                <i class="fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>
                            </button>
                            <span class="text-sm text-gray-500">{{ $option->name }}</span>
                        </div>

                        {{--valores--}}
                        <div class="flex flex-wrap gap-2">
                            @foreach($option->pivot->features as $feature)
                                <div class="flex items-start gap-2 mb-2">
                                    <div class="flex items-center gap-2">
                                        @switch($option['type'])
                                            @case(2)
                                                <div class="badge badge-neutral badge-outline text-sm text-gray-{{ $feature['id'] }} rounded-md" wire:key="feature-{{ $feature['id'] }}">
                                                    <span class="badge badge-xs mr-2" style="background-color: {{ $feature['value'] }}; border: 1px solid #ccc;"></span>
                                                    {{ $feature['description'] }}
                                                    <button class="ml-2" wire:click="removeFeatureFromOption({{ $option->id }}, {{ $feature['id'] }})">
                                                        <i class="fa-solid fa-xmark text-red-500 hover:text-red-600"></i>
                                                    </button>
                                                </div>
                                                @break
                                            @case(1)
                                                <div class="badge badge-neutral badge-outline text-sm text-gray-200 rounded-md">
                                                    {{ $feature['description'] }}
                                                    <button class="ml-2" wire:click="removeFeatureFromOption({{ $option->id }}, {{ $feature['id'] }})">
                                                        <i class="fa-solid fa-xmark text-red-500 hover:text-red-600"></i>
                                                    </button>
                                                </div>
                                                @break
                                            @default
                                                <span class="text-sm text-gray-200">{{ $feature['description'] }}</span>
                                        @endswitch

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="rounded-lg bg-white p-4 shadow-md">
        <header class="border-b border-gray-200 px-6 py-2">
            <div class="flex justify-between">
                <h1>
                    Variantes
                </h1>
            </div>
        </header>
        <div class="p-4">
            <ul>
                @foreach($product->variants as $variant)
                    <li class="border border-gray-200 rounded-md p-2 mb-2 flex items-center gap-2" wire:key="product-variant-{{ $variant->id }}">
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-500">
                                @foreach($variant->features as $feature)
                                    {{ $feature->description }}@if(!$loop->last), @endif
                                @endforeach
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            Agregar Opción
        </x-slot>
        <x-slot name="content">
            <div class="flex flex-col gap-4">
                <x-label>Opción</x-label>
                <select wire:model.lazy="variant.option_id"
                wire:change="updateOptionVariantId()"
                class="w-full p-2 border border-gray-300 rounded-md">
                    <option value="" disabled>Seleccionar Opción</option>
                    @foreach($options as $option)
                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                    @endforeach
                </select>
                @error('variant.option_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <div class="flex items-center gap-2 mb-6">
                    <hr class="flex-grow border-gray-600">
                    <span class="mx-4">Valores</span>
                    <hr class="flex-grow border-gray-600">
                </div>

                <ul class="mb-4">
                    @foreach($variant['features'] as $index => $feature)
                        <li wire:key="variant-feature-{{ $index }}" class="relative border border-gray-300 rounded-md p-2 mb-2 flex items-center gap-2">
                            <div class="absolute -top-3 px-2 py-1 bg-gray-800 text-sm rounded-md">
                                <button wire:click="removeFeature({{ $index }})">
                                    <i class="fa-solid fa-trash text-red-400 hover:text-red-600"></i>
                                </button>
                            </div>
                            <div class="p-3 w-full">
                                <x-label class="text-sm mb-1">
                                    Valores
                                </x-label>
                                <select wire:model="variant.features.{{ $index }}.id"
                                wire:change="featureChange({{ $index }})"
                                class="w-full p-2 border border-gray-300 rounded-md">
                                    <option value="" disabled>Seleccionar un valor</option>
                                    @foreach($this->features as $item)
                                        <option value="{{ $item->id }}">{{ $item->description }}</option>
                                    @endforeach
                                </select>


                            </div>

                        </li>
                    @endforeach
                </ul>
                @error('variant.features.*.id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <div class="flex justify-end">
                    <button class="btn btn-secondary btn-sm" wire:click="addFeature()">
                            <i class="fas fa-plus"></i> Agregar valor
                    </button>
                </div>


            </div>
            <div class="flex items-center gap-2 mt-6">
                    <hr class="flex-grow border-gray-600">
                </div>
        </x-slot>

        <x-slot name="footer">
                <div class="flex justify-end gap-2">
                    <button class="btn btn-neutral btn-sm text-white" wire:click="$set('openModal', false)">
                            <i class="fas fa-close"></i> Cancelar
                    </button>
                <button class="btn btn-primary btn-sm" wire:click="save()">
                            <i class="fas fa-save"></i> Guardar
                    </button>}
                </div>
        </x-slot>
    </x-dialog-modal>
</div>
