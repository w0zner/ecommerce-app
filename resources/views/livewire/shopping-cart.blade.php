<div>
    <div class="grid grid-cols-7 gap-6">
        <div class="col-span-5">
            <div class="flex justify-between mb-2">
                <h2 class="text-2xl font-bold">Carrito de compras ({{$cartItems->count()}} Productos)</h2>

                <button class="btn btn-error text-white rounded-md">
                    <i class="fas fa-trash"></i>
                    Limpiar Carrito
                </button>
            </div>
            <div class="card bg-base-100 shadow-sm p-4">
                <ul class="list-group space-y-4">
                    @foreach($cartItems as $item)
                        <li class="list-group-item flex">
                            <img class="w-36 rounded-md aspect-square object-cover object-center shadow-md mr-4" src="{{json_decode($item->options)->image}}" alt="">

                            <div class="w-80">
                                <p class="text-lg font-bold">
                                    <a href="{{route('products.show', $item->itemable->id)}}">
                                        {{$item->itemable->name}}
                                    </a>
                                </p>
                                <button class="btn btn-xs btn-error text-white rounded-md">
                                    <i class="fa-solid fa-xmark"></i>
                                    Quitar
                                </button>
                            </div>

                            <p class="text-lg font-bold">
                                Gs. {{ number_format($item->itemable->price, 0, ',', '.') }}
                            </p>

                            <div class="ml-auto">
                                <button class="btn btn-secondary btn-sm rounded-md" ><i class="fa-solid fa-minus"></i></button>
                                <span class="font-semibold inline-block w-3 text-center mr-2 ml-2">{{$item->quantity}}</span>
                                <button class="btn btn-secondary btn-sm rounded-md"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </li>

                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-span-2">

        </div>
    </div>
</div>
