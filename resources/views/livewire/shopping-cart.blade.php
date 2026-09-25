<div>
    <div class="grid grid-cols-1 lg:grid-cols-7 gap-6">
        <div class="lg:col-span-5">
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
                        <li class="list-group-item lg:flex">
                            <img class="w-full lg:w-36  rounded-md aspect-square object-cover object-center shadow-md mr-4" src="{{json_decode($item->options)->image}}" alt="">

                            <div class="w-full lg:w-80 flex md:block justify-between items-center mt-2 lg:mt-0">
                                <p class="text-lg font-bold">
                                    <a href="{{route('products.show', $item->itemable->id)}}">
                                        {{$item->itemable->name}}
                                    </a>
                                </p>
                                <button class="btn btn-xs btn-error text-white rounded-md shadow-md">
                                    <i class="fa-solid fa-xmark"></i>
                                    Quitar
                                </button>
                            </div>

                            <p class="text-lg font-bold">
                                Gs. {{ number_format($item->itemable->price, 0, ',', '.') }}
                            </p>

                            <div class="ml-auto space-x-3">
                                <button class="btn btn-secondary btn-sm rounded-md shadow-md" ><i class="fa-solid fa-minus"></i></button>
                                <span class="font-semibold inline-block w-3 text-center">{{$item->quantity}}</span>
                                <button class="btn btn-secondary btn-sm rounded-md shadow-md"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </li>

                    @endforeach
                </ul>
            </div>
        </div>
        <div class="lg:col-span-2 lg:pt-5">
            <div class="card bg-base-100 shadow-sm p-4 lg:mt-8">
                <div class="flex justify-between items-center p-between mb-3">
                    <p class="text-lg font-bold">Total</p>
                    <p class="text-lg font-bold">Gs. {{ number_format($totalPrice, 0, ',', '.') }}</p>
                </div>
                <a class="btn bg-purple-600 hover:bg-purple-700 text-white btn-block rounded-md">
                    Continuar compra
                </a>
            </div>

        </div>
        </div>
    </div>
</div>
