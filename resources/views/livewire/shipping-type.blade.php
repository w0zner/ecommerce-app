<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="bg-purple-600 text-white p-3 flex justify-between items-center">
        <p class="font-semibold">Resumen de la compra ({{ $cartItems->count() }})</p>
        <a href="{{ route('cart.index') }}"><i class="fa-solid fa-cart-shopping"></i></a>
    </div>
    <div class="p-3">
        <ul>
            @foreach ($cartItems as $item)
                <li class="flex items-center space-x-4">
                    <figure class="shrink-0">
                        <img class="w-full lg:w-36  rounded-md aspect-square object-cover object-center shadow-lg mr-4"
                            src="{{ json_decode($item->options)->image }}" alt="">
                    </figure>
                    <div class="flex-1">
                        <p class="truncate font-bold">{{ $item->itemable->name }}</p>

                        <p class="text-sm">
                            Gs. {{ number_format($item->itemable->price, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="shrink-0 mr-2">
                        <p class="text-lg font-bold">{{ $item->quantity }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
        <hr class="my-4">
        <div>
            <label class="mr-5 space-x-1 cursor-pointer">
                <input type="radio" name="shipping_type" wire:model.live="shippingType" value="delivery" @disabled(!$addresses || $addresses->count() == 0)
                    class="radio bg-green-100 border-green-300 checked:bg-green-500 checked:text-green-600 checked:border-green-600" />
                <span>Delivery</span>
            </label>
            <label class="mr-5 space-x-1 cursor-pointer">
                <input type="radio" name="shipping_type" wire:model.live="shippingType" value="carry_out"
                    class="radio bg-black-100 border-black-300 checked:bg-black-200 checked:text-black-600 checked:border-black-600" />
                <span>Carry out</span>
            </label>
            <div class="flex justify-between mt-2">
                <p class="text-lg">Costo de envío:</p>
                <p class="text-lg">Gs. {{ number_format($shippingCost, 0, ',', '.') }}</p>
            </div>
        </div>


        <hr class="my-4">
        <div>
            <div class="flex justify-between">
                <p class="text-lg">Subtotal</p>
                <p class="text-lg">Gs. {{ number_format($totalPrice, 0, ',', '.') }}</p>
            </div>
            <div class="flex justify-between mt-1">
                <p class="text-lg font-bold">Total</p>
                <p class="text-lg font-bold">Gs. {{ number_format($totalPrice + $shippingCost, 0, ',', '.') }}</p>
            </div>
        </div>
        <hr class="my-4">
        <a href="{{ route('checkout.index') }}"
            class="btn bg-purple-600 hover:bg-purple-700 text-white btn-block rounded-md shadow-md">
            Continuar compra
            <i class="fa-solid fa-circle-arrow-right"></i>
        </a>
    </div>
</div>
