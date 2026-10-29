<x-app-layout>
    <x-container class="px-4 my-4">
        <div class="breadcrumbs text-sm">
        <ul>
            <li><a href="{{ route('welcome.index') }}">Home</a></li>
            <li><span class="text-gray-600 cursor-pointer">Carrito de compras</span></li>
        </ul>
        </div>
    </x-container>
    <x-container class="mt-12 px-4">
        @if (session('error'))
        <div class="grid grid-cols-1 lg:grid-cols-7 gap-6">
        <div class="lg:col-span-5">
            <div role="alert" class="alert alert-error text-white mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span><span class="text-lg font-bold">¡Atención! </span>{{ session('error') }}</span>
            </div>
        </div>
        </div>
        @endif
        @if(count($cartItems) > 0)
            @livewire('shopping-cart', ['cart' => $cart])
        @else
            <div role="alert" class="alert alert-vertical sm:alert-horizontal">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current text-info h-6 w-6 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>No tiene productos en su carrito de compras!</span>
                <div>
                    <a role="button" class="btn btn-primary text-white" href="{{route('welcome.index')}}">Volver a la tienda</a>
                </div>
            </div>
        @endif
    </x-container>

</x-app-layout>
