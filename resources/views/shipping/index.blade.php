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
                                    <img class="w-full lg:w-36  rounded-md aspect-square object-cover object-center shadow-md mr-4" src="{{json_decode($item->options)->image}}" alt="">
                                    <div>
                                        <p>{{$item->itemable->name}}</p>
                                    </div>
                                    <div>

                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</x-app-layout>
