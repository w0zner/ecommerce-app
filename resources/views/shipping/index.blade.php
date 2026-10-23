<x-app-layout>
    <x-container class="mt-12">
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2">
                @livewire('shipping-addresses')
            </div>
            <div class="col-span-1">
                @livewire('shipping-type', ['cart' => $cart, 'cartItems' => $cartItems, 'totalPrice' => $totalPrice])
            </div>
        </div>
    </x-container>
</x-app-layout>
