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
                        <input type="text" placeholder="Direccion" class="input w-full" wire:model="createAddress.description"/>
                        @error('createAddress.description')
                            <span class="text-sm text-error"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="district">Ciudad</label>
                        <input type="text" placeholder="Ciudad" wire:model="createAddress.district" class="input w-full" />
                         @error('createAddress.district')
                            <span class="text-sm text-error"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="reference">Referencia</label>
                        <input type="text" placeholder="Referencia" wire:model="createAddress.reference" class="input w-full" />
                         @error('createAddress.reference')
                            <span class="text-sm text-error"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <hr class="my-4" />
                <div x-data="{
                        receiver: @entangle('createAddress.receiver'),
                        receiver_info: @entangle('createAddress.receiver_info')
                    }"
                    x-init="$watch('receiver', value => {
                        if(value==1) {
                            receiver_info.name= '{{ Auth::user()->name }}';
                            receiver_info.last_name='{{ Auth::user()->last_name }}';
                            receiver_info.document_type='{{ Auth::user()->document_type }}';
                            receiver_info.document_number='{{ Auth::user()->document_number }}';
                            receiver_info.phone='{{ Auth::user()->phone }}';
                        } else {
                            receiver_info.name='';
                            receiver_info.last_name='';
                            receiver_info.document_number='';
                            receiver_info.phone='';
                        }
                    })"
                >
                    <p class="ml-1 mb-2 font-semibold">Quien recibira el pedido?</p>
                    <div class="flex items-center space-x-4">
                        <label class="mr-4">
                            <input x-model="receiver" type="radio" name="recipient" value="1" wire:model="createAddress.receiver" />
                            <span class="ml-1">Sere Yo</span>
                        </label>
                        <label>
                            <input type="radio" name="recipient" value="2" wire:model="createAddress.receiver" />
                            <span x-model="receiver" class="ml-1">Otra persona</span>
                        </label>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-4" x-data="{
                    receiver: @entangle('createAddress.receiver'),
                    receiver_info: @entangle('createAddress.receiver_info')
                }">
                    <div class="col-span-2">
                        <label for="district">Nombres</label>
                        <input type="text" :disabled="receiver==1" x-model="receiver_info.name" placeholder="Nombres"  class="input w-full" />
                         @error('createAddress.receiver_info.name')
                            <span class="text-sm text-error"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="reference">Apellidos</label>
                        <input type="text" :disabled="receiver==1" x-model="receiver_info.last_name" placeholder="Apellidos" class="input w-full" />
                    </div>
                    <div class="col-span-2">
                        <label for="district">Número de documento</label>
                        <div class="flex justify-between items-center gap-1">
                            <div class="w-1/5">
                                <select :disabled="receiver==1" x-model="receiver_info.document_type" id="document_type" class="select selec-sm block mt-1 input w-full border bg-slate-100 border-gray-300" name="document_type" required>
                                    @foreach (\App\Enums\TypeOfDocuments::cases() as $item)
                                        <option value="{{$item->value}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div  class="w-full">
                                <input :disabled="receiver==1" type="text" x-model="receiver_info.document_number" placeholder="Número de documento"  class="input w-full" />
                                 @error('createAddress.receiver_info.document_number')
                                    <span class="text-sm text-error"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="col-span-2">
                        <label for="reference">Teléfono</label>
                        <input type="text"  x-model="receiver_info.phone" placeholder="Teléfono"  class="input w-full" />
                         @error('createAddress.receiver_info.phone')
                            <span class="text-sm text-error"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <hr class="my-4" />
                <div class="grid grid-cols-4 gap-4 mt-4">
                    <div class="col-span-2">
                        <button class="btn btn-outline btn-error w-full" wire:click="$set('showForm', false)">
                            Cancelar
                        </button>
                    </div>
                    <div class="col-span-2">
                        <button class="btn btn-primary w-full" wire:click="store()">
                            Guardar
                        </button>
                    </div>
                </div>

            @else
                @if($editAddress->id)

                    <div class="grid grid-cols-4 gap-4">
                    <div class="col-span-1">
                        <label for="type">Tipo dirección</label>
                        <select class="select" id="type" wire:model="editAddress.type">
                            <option disabled selected>Seleccione una opción</option>
                            <option value="1">Domicilio</option>
                            <option value="2">Oficina</option>
                        </select>
                    </div>
                    <div class="col-span-3">
                        <label for="type">Nombre de dirección</label>
                        <input type="text" placeholder="Direccion" class="input w-full" wire:model="editAddress.description"/>
                        @error('editAddress.description')
                            <span class="text-sm text-error"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="district">Ciudad</label>
                        <input type="text" placeholder="Ciudad" wire:model="editAddress.district" class="input w-full" />
                         @error('editAddress.district')
                            <span class="text-sm text-error"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="reference">Referencia</label>
                        <input type="text" placeholder="Referencia" wire:model="editAddress.reference" class="input w-full" />
                         @error('editAddress.reference')
                            <span class="text-sm text-error"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <hr class="my-4" />
                <div x-data="{
                        receiver: @entangle('editAddress.receiver'),
                        receiver_info: @entangle('editAddress.receiver_info')
                    }"
                    x-init="$watch('receiver', value => {
                        if(value==1) {
                            receiver_info.name= '{{ Auth::user()->name }}';
                            receiver_info.last_name='{{ Auth::user()->last_name }}';
                            receiver_info.document_type='{{ Auth::user()->document_type }}';
                            receiver_info.document_number='{{ Auth::user()->document_number }}';
                            receiver_info.phone='{{ Auth::user()->phone }}';
                        } else {
                            receiver_info.name='';
                            receiver_info.last_name='';
                            receiver_info.document_number='';
                            receiver_info.phone='';
                        }
                    })"
                >
                    <p class="ml-1 mb-2 font-semibold">Quien recibira el pedido?</p>
                    <div class="flex items-center space-x-4">
                        <label class="mr-4">
                            <input x-model="receiver" type="radio" name="recipient" value="1" wire:model="editAddress.receiver" />
                            <span class="ml-1">Sere Yo</span>
                        </label>
                        <label>
                            <input type="radio" name="recipient" value="2" wire:model="editAddress.receiver" />
                            <span x-model="receiver" class="ml-1">Otra persona</span>
                        </label>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-4" x-data="{
                    receiver: @entangle('editAddress.receiver'),
                    receiver_info: @entangle('editAddress.receiver_info')
                }">
                    <div class="col-span-2">
                        <label for="district">Nombres</label>
                        <input type="text" :disabled="receiver==1" x-model="receiver_info.name" placeholder="Nombres"  class="input w-full" />
                         @error('editAddress.receiver_info.name')
                            <span class="text-sm text-error"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="reference">Apellidos</label>
                        <input type="text" :disabled="receiver==1" x-model="receiver_info.last_name" placeholder="Apellidos" class="input w-full" />
                    </div>
                    <div class="col-span-2">
                        <label for="district">Número de documento</label>
                        <div class="flex justify-between items-center gap-1">
                            <div class="w-1/5">
                                <select :disabled="receiver==1" x-model="receiver_info.document_type" id="document_type" class="select selec-sm block mt-1 input w-full border bg-slate-100 border-gray-300" name="document_type" required>
                                    @foreach (\App\Enums\TypeOfDocuments::cases() as $item)
                                        <option value="{{$item->value}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div  class="w-full">
                                <input :disabled="receiver==1" type="text" x-model="receiver_info.document_number" placeholder="Número de documento"  class="input w-full" />
                                 @error('editAddress.receiver_info.document_number')
                                    <span class="text-sm text-error"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="col-span-2">
                        <label for="reference">Teléfono</label>
                        <input type="text"  x-model="receiver_info.phone" placeholder="Teléfono"  class="input w-full" />
                         @error('editAddress.receiver_info.phone')
                            <span class="text-sm text-error"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <hr class="my-4" />
                <div class="grid grid-cols-4 gap-4 mt-4">
                    <div class="col-span-2">
                        <button class="btn btn-outline btn-error w-full" wire:click="$set('editAddress.id', null)">
                            Cancelar
                        </button>
                    </div>
                    <div class="col-span-2">
                        <button class="btn btn-primary w-full" wire:click="update()">
                            Actualizar
                        </button>
                    </div>
                </div>

                @else
                    @if (count($addresses) > 0)
                    <ul class="grid grid-cols-3 gap-4">
                        @foreach ($addresses as $address)
                            <li class="{{$address->default ? 'bg-purple-200' : 'bg-white'}} p-2 rounded-md shadow-md cursor-pointer">
                                <div class="p-4 flex items-center">
                                    <div>
                                        {{-- <i class="fas fa-map-marker-alt"></i> --}}
                                        <i class="fa-solid fa-house text-xl {{$address->default ? 'text-purple-600' : 'text-gray-700'}}"></i>
                                    </div>
                                    <div class="flex-1 mx-4 text-xs">
                                        <p class="font-semibold text-gray-800">{{$address->type == 1 ? 'Domicilio' : 'Oficina'}}</p>
                                        <p class="text-gray-700">{{$address->district}}</p>
                                        <p class="text-gray-700">{{$address->description}}</p>
                                        <p class="{{$address->default ? 'text-purple-800 font-bold' : 'text-gray-700'}}">{{$address->receiver_info['name'] . ' ' . $address->receiver_info['last_name']}} - {{$address->receiver_info['phone']}}</p>
                                    </div>
                                    <div class="flex flex-col items-center gap-1 text-gray-700">
                                        <button wire:click="setDefault({{$address->id}})"><i class="fa-solid fa-star {{$address->default ? 'text-purple-600' : 'text-gray-700'}}"></i></button>
                                        <button wire:click="edit({{$address->id}})"><i class="fas fa-edit"></i></button>
                                        <button wire:click="delete({{$address->id}})"><i class="fas fa-trash hover:text-red-600"></i></button>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div role="alert" class="alert alert-vertical border-0 sm:alert-horizontal bg-white items-center">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current text-info h-6 w-6 shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg> --}}
                        <span>No tiene direcciones registradas!</span>
                        {{-- <div>
                            <a role="button" class="btn btn-primary text-white" href="{{route('welcome.index')}}">Volver a la tienda</a>
                        </div> --}}
                    </div>

                @endif
                @endif

                @if($editAddress->id == null)
                    <button class="btn btn-outline btn-primary text-white w-full mt-2" wire:click="set('showForm', true)">
                        Agregar
                        <i class="fas fa-plus"></i>
                    </button>
                @endif
            @endif

        </div>
    </section>
</div>
