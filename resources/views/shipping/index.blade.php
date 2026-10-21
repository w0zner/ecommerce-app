<x-app-layout>
    <x-container class="mt-12">
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2">
                @livewire('shipping-addresses')
            </div>
            <div class="col-span-1">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="bg-purple-600 text-white p-3 flex justify-between items-center">
                        <p class="font-semibold">Resumen de la compra ({{$cartItems->count()}})</p>
                        <a href="{{ route('cart.index') }}"><i class="fa-solid fa-cart-shopping"></i></a>
                    </div>
                    <div class="p-3">
                        <ul>
                            @foreach($cartItems as $item)
                                <li class="flex items-center space-x-4">
                                    <figure class="shrink-0">
                                        <img class="w-full lg:w-36  rounded-md aspect-square object-cover object-center shadow-md mr-4" src="{{json_decode($item->options)->image}}" alt="">
                                    </figure>
                                    <div class="flex-1">
                                        <p class="truncate font-bold">{{$item->itemable->name}}</p>

                                        <p class="text-sm">
                                            Gs. {{ number_format($item->itemable->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="shrink-0 mr-2">
                                        <p class="text-lg font-bold">{{$item->quantity}}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <hr class="my-4">
                        <div class="flex justify-between">
                            <p class="text-lg">Total</p>
                            <p class="text-lg font-bold">Gs. {{ number_format($totalPrice, 0, ',', '.') }}</p>
                        </div>
                        <hr class="my-4">
                        <a href="{{route('shipping.index')}}" class="btn bg-purple-600 hover:bg-purple-700 text-white btn-block rounded-md shadow-md">
                            Continuar compra
                            <i class="fa-solid fa-circle-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</x-app-layout>
