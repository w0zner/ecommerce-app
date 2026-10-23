<x-app-layout>
    <div class="-mb-16 text-gray-700" x-data="{pago: 1}">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="col-span-1 bg-white">
                <div class="lg:max-w-[40rem] py-12 px-4 lg:pr-8 sm:pl-6 lg:pl-8 ml-auto">
                    <h1 class="text-2xl font-semibold mb-2">Pago</h1>
                    <div class="shadow-md rounded-lg overflow-hidden border border-gray-300">
                        <ul>
                            <li>
                                <label class="p-4 flex items-center gap-2">
                                    <input type="radio" name="pago" value="1" x-model="pago">
                                    <span>Transferencia Bancaria</span>
                                </label>
                                <div class="p-4 bg-gray-100 text-center border-t border-gray-400" x-show="pago==1">
                                    <i class="fa-solid fa-money-bill-transfer text-9xl"></i>
                                    <div class="text-left">
                                        <p class="mt-2">Datos para transferencia:</p>
                                        <b>- Alias:</b>
                                        <p>RUC - 80065231-8</p>
                                        <br>
                                        <b>- Datos Bancarios:</b>
                                        <p>RUC: 80065231-8</p>
                                        <p>Titular: Mi tienda SAE</p>
                                        <p>Banco: Familiar</p>
                                        <p>Nro de cuenta SIPAP: 816235587</p>
                                    </div>
                                </div>
                            </li>
                            <hr class=" border-t border-gray-500">
                            <li>
                                <label class="p-4 flex items-center gap-2">
                                    <input type="radio" name="pago" value="2" x-model="pago">
                                    <span>Link de pago</span>
                                    <img src="https://avatars.githubusercontent.com/u/22105487?s=200&v=4" alt="credit-card" class="h-8 ml-auto">
                                </label>
                                <div class="p-4 bg-gray-100 text-center border-t border-gray-400" x-show="pago==2">
                                    <i class="fa-brands fa-cash-app text-9xl"></i>
                                    <p class="mt-2">Luego de hacer click en "Finalizar compra", se enviará el pedido por Whatsapp donde te enviaremos un Link para completar tu compra de forma segura.</p>
                                </div>
                            </li>
                            <hr class=" border-t border-gray-500">
                            <li>
                                <label class="p-4 flex items-center gap-2 text-gray-400">
                                    <input type="radio" name="pago" value="3" x-model="pago" disabled>
                                    <span>Tarjeta de débito/crédito</span>
                                    <img src="https://codersfree.com/img/payments/credit-cards.png" alt="credit-card" class="h-8 ml-auto">
                                </label>
                                <div class="p-4 bg-gray-100 text-center border-t border-gray-400" x-show="pago==3">
                                    <i class="fa-regular fa-credit-card text-9xl"></i>
                                    <p class="mt-2">Luego de hacer click en "Finalizar compra", se abrirá el checkout de Bancard para completar tu compra de forma segura.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-span-1">
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                <div class="lg:max-w-[40rem] py-12 px-4 lg:pl-8 sm:pr-6 lg:pr-8 mr-auto">
                    <div class="overflow-hidden">
                    <div class=" p-3 flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('shipping.index') }}"><i class="fa-solid fa-circle-arrow-left"></i></a>
                            <h1 class="text-2xl font-semibold ">Resumen de la compra ({{$cartItems->count()}})</h1>
                        </div>
                        <a href="{{ route('cart.index') }}"><i class="fa-solid fa-cart-shopping"></i></a>
                    </div>
                    <div class="p-3">
                        <ul>
                            @foreach($cartItems as $item)
                                <li class="flex items-center space-x-4">
                                    <figure class="shrink-0">
                                        <img class="w-full lg:w-36  rounded-md aspect-square object-cover object-center shadow-lg mr-4" src="{{json_decode($item->options)->image}}" alt="">
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
                            <p class="text-lg">SubTotal</p>
                            <p class="text-md">Gs. {{ number_format($totalPrice, 0, ',', '.') }}</p>
                        </div>

                        <div class="flex justify-between">
                            <p class="text-lg">Precio de envío</p>
                            <p class="text-md">Gs. {{ number_format($precioEnvio, 0, ',', '.') }}</p>
                        </div>
                        <hr class="my-4">
                        <div class="flex justify-between">
                            <p class="text-lg font-bold">Total</p>
                            <p class="text-lg font-bold">Gs. {{ number_format($totalPrice + $precioEnvio, 0, ',', '.') }}</p>
                        </div>
                        <hr class="my-4">
                        <input type="hidden" name="pago" :value="pago">
                        <button type="submit" class="btn bg-purple-600 hover:bg-purple-700 text-white btn-block rounded-md shadow-md">
                            Finalizar compra
                            <i class="fa-solid fa-circle-check"></i>
                        </button>
                    </div>
                </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
