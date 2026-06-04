

<div>
    <div class="flex justify-center items-start flex-col p-4 pt-1">
        <header>
            <div class="flex justify-between">
            <h1>
                Opciones
            </h1>
            <x-button custom wire:click="$set('openModal', true)" class="bg-[#2b3440] text-white text-sm px-4 py-2 hover:bg-[#1d232a]">
                Agregar
            </x-button>
        </div>
        </header>

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
        </x-slot>
        <x-slot name="footer">

        </x-slot>
    </x-dialog-modal>
</div>
