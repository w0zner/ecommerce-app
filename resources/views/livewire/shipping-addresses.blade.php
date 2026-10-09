<div>
    <section class="bg-white rounded-md shadow-md overflow-hidden">
        <header class="bg-gray-900 px-4 py-2">
            <h2 class="text-white font-bold text-lg">Direcciones de envío guardadas</h2>
        </header>
        <div class="p-4">
            @if ($showForm)
                <div class="grid grid-cols-4 gap-4">
                    <div class="col-span-1">
                        <label for="type">Tipo dirección</label>
                        <select class="select" id="type" wire:model="createAddress.type">
                            <option disabled selected>Seleccione una opción</option>
                            <option value="1">Domicilio</option>
                            <option value="2">Oficina</option>
                        </select>
                    </div>
                    <div class="col-span-3">
                        <label for="type">Nombre de dirección</label>
                        <input type="text" placeholder="Type here" class="input w-full" />
                    </div>
                    <div class="col-span-2">
                        <label for="district">Ciudad</label>
                        <input type="text" placeholder="Ciudad" wire:model="createAddress.district" class="input w-full" />
                    </div>
                    <div class="col-span-2">
                        <label for="reference">Referencia</label>
                        <input type="text" placeholder="Referencia" wire:model="createAddress.reference" class="input w-full" />
                    </div>
                </div>
                <hr class="my-4" />
                <div>
                    <p class="ml-1 mb-2 font-semibold">Quien recibira el pedido?</p>
                    <div class="flex items-center space-x-4">
                        <label class="mr-4">
                            <input type="radio" name="recipient" value="1" wire:model="createAddress.receiver" />
                            <span class="ml-1">Sere Yo</span>
                        </label>
                        <label>
                            <input type="radio" name="recipient" value="2" wire:model="createAddress.receiver" />
                            <span class="ml-1">Otra persona</span>
                        </label>
                    </div>
                </div>
            @else
                 @if (count($addresses) > 0)

                @else
                    <div role="alert" class="alert alert-vertical sm:alert-horizontal bg-white">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current text-info h-6 w-6 shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg> --}}
                        <span>No tiene direcciones registradas!</span>
                        {{-- <div>
                            <a role="button" class="btn btn-primary text-white" href="{{route('welcome.index')}}">Volver a la tienda</a>
                        </div> --}}
                    </div>
                    <button class="btn btn-outline btn-primary text-white w-full mt-2" wire:click="set('showForm', true)">
                        Agregar
                        <i class="fas fa-plus"></i>
                    </button>
                @endif
            @endif

        </div>
    </section>
</div>
