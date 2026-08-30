<x-app-layout>
    <x-container class="px-4 my-4">
        <div class="breadcrumbs text-sm">
        <ul>
            <li><a href="{{ route('welcome.index') }}">Home</a></li>
            <li><a href="{{route('families.show', $product->subcategory->category->family->id)}}">{{ $product->subcategory->category->family->name }}</a></li>
            <li><a href="{{route('categories.show', $product->subcategory->category->id)}}">{{ $product->subcategory->category->name }}</a></li>
            <li><a>{{ $product->subcategory->name }}</a></li>
        </ul>
        </div>
    </x-container>
    <x-container>
        <div class="card">
            <div class="grid md:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <figure class="mb-2">
                        <img src="{{$product->image}}" alt="{{$product->name}}" class="rounded-md aspect-[16/9] w-full object-cover object-center shadow-slate-500">
                    </figure>
                    <div class="text-sm text-gray-700">
                        {{$product->description}}
                    </div>
                </div>
                <div class="col-span-1">
                    <h1 class="text-xl text-gray-700 mb-2">{{$product->name}}</h1>
                    <div class="flex space-x-2 items-center mb-4">
                        <ul class="flex space-x-1 text-sm">
                            <li><i class="fa-solid fa-star text-yellow-400 cursor-pointer"></i></li>
                            <li><i class="fa-solid fa-star text-yellow-400 cursor-pointer"></i></li>
                            <li><i class="fa-solid fa-star text-yellow-400 cursor-pointer"></i></li>
                            <li><i class="fa-solid fa-star text-yellow-400 cursor-pointer"></i></li>
                            <li><i class="fa-solid fa-star text-yellow-400 cursor-pointer"></i></li>
                        </ul>
                        <p class="text-sm text-gray-500">4.7 (55 personas)</p>
                    </div>
                    <p class="font-semibold text-2xl text-gray-600 mb-6">
                        Gs. {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <div class="flex items-center space-x-6 mb-6">
                        <button class="btn btn-secondary btn-sm rounded-md"><i class="fa-solid fa-minus"></i></button>
                        <span class="font-semibold">1</span>
                        <button class="btn btn-secondary btn-sm rounded-md"><i class="fa-solid fa-plus"></i></button>
                    </div>
                    <button class="btn btn-sm bg-purple-500 text-white rounded-md w-full mb-5 hover:text-purple-500">
                        <i class="fa-solid fa-basket-shopping"></i> Agregar al carrito
                    </button>
                    <div class="flex items-center space-x-3 text-gray-700">
                        <i class="fa-solid fa-truck-fast text-2xl"></i>
                        <p>Envios a todo el país</p>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</x-app-layout>
