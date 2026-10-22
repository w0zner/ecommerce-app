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
                                    <span>Tarjeta de débito/crédito</span>
                                    <img src="https://codersfree.com/img/payments/credit-cards.png" alt="credit-card" class="h-8 ml-auto">
                                </label>
                                <div class="p-4 bg-gray-100 text-center">
                                    <i class="fa-regular fa-credit-card text-7xl"></i>
                                </div>
                            </li>
                            <hr class="my-4 border-t border-gray-300">
                            <li>
                                <label class="p-4 flex items-center gap-2">
                                    <input type="radio" name="pago" value="2" x-model="pago">
                                    <span>Transferencia Bancaria</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-span-1">
                <div class="lg:max-w-[40rem] py-12 px-4 lg:pl-8 sm:pr-6 lg:pr-8 mr-auto">
                    <p>lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptas. lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptas. lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptas.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
