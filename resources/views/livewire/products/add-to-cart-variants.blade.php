    <x-container>
        <div class="card">
            <div class="grid md:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <figure class="mb-2">
                        <img src="{{$this->variant->image}}" alt="{{$product->name}}" class="rounded-md aspect-[1/1] w-full object-cover object-center shadow-slate-500">
                    </figure>

                </div>
                <div class="col-span-1">
                    <h1 class="text-xl text-gray-700 mb-2">{{$product->name}}</h1>
                    <div class="flex space-x-2 items-center mb-4">
                        <ul class="flex space-x-1 text-sm">
                            <li><i class="fa-solid fa-star text-yellow-400 cursor-pointer"></i></li>
                            <li><i class="fa-solid fa-star text-yellow-400 cursor-pointer"></i></li>
                            <li><i class="fa-solid fa-star text-yellow-400 cursor-pointer"></i></li>
                            <li><i class="fa-solid fa-star text-yellow-400 cursor-pointer"></i></li>
                            <li><i class="fa-solid fa-star text-yellow-400 cursor-pointer"></i></li>
                        </ul>
                        <p class="text-sm text-gray-500">4.7 (55 personas)</p>
                    </div>
                    <p class="font-semibold text-2xl text-gray-600 mb-6">
                        Gs. {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <div class="flex items-center space-x-6 mb-6" x-data="{qty: @entangle('qty')}">
                        <button class="btn btn-secondary btn-sm rounded-md" x-on:click="qty= qty-1" x-bind:disabled="qty==1"><i class="fa-solid fa-minus"></i></button>
                        <span class="font-semibold" x-text="qty" class="inline-block w-3 text-center"></span>
                        <button class="btn btn-secondary btn-sm rounded-md" x-on:click="qty= qty+1"><i class="fa-solid fa-plus"></i></button>
                    </div>
                    <div class="flex flex-wrap space-x-2">

                        @foreach($product->options as $option)
                            <div class="mr-4 mb-4">
                                <span class="font-semibold text-lg mb-2">{{$option->name}}:</span>

                                <ul class="flex flex-wrap space-x-4">
                                    @foreach($option->pivot->features as $feature)
                                        <li class="cursor-pointer text-sm px-2 py-1">
                                            @if($option->name == 'Color')
                                                <button class="btn btn-soft rounded-md {{$feature['value']=='white'? 'text-purple-600' : 'text-white'}} {{ $selected_features[$option->id] == $feature['id'] ? 'border-4 border-solid border-purple-600 text-bold' : '' }}" wire:click="set('selected_features.{{$option->id}}', {{$feature['id']}})" style="background-color: {{$feature['value']}};">
                                                    {{$feature['description']}}
                                                </button>
                                            @else
                                                <button class="btn btn-soft rounded-md {{ $selected_features[$option->id] == $feature['id'] ? 'bg-purple-500 text-white' : '' }}" wire:click="set('selected_features.{{$option->id}}', {{$feature['id']}})">
                                                    {{$feature['description']}}
                                                </button>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach


                    </div>
                    <button class="btn btn-sm bg-purple-500 text-white rounded-md w-full mb-5 hover:text-purple-500" wire:click="add_to_cart()" wire:loading.attr="disabled">
                        <i class="fa-solid fa-basket-shopping"></i> Agregar al carrito
                    </button>
                    <button wire:click="eliminar()">
                        ELiminar
                    </button>
                    <div class="text-sm text-gray-700 mb-4">
                        {{$product->description}}
                    </div>
                    <div class="flex items-center space-x-3 text-gray-700">
                        <i class="fa-solid fa-truck-fast text-2xl"></i>
                        <p>Envios a todo el país</p>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
