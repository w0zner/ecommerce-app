<x-app-layout>
    <x-container class="mt-12 px-4">
        @if($cartItems->count() > 0)
            {{-- {{$cartItems}} --}}
            @livewire('shopping-cart', ['cartItems' => $cartItems])
        @else
            <div role="alert" class="alert alert-vertical sm:alert-horizontal">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current text-info h-6 w-6 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>No tiene productos en su carrito de compras!</span>
                <div>
                    <a role="button" class="btn btn-sm btn-primary" href="{{route('welcome.index')}}">Volver a la tienda</a>
                </div>
            </div>
        @endif
    </x-container>

</x-app-layout>
