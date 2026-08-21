<div class="bg-white py-8">
    <x-container class="px-4 md:flex">
        @if($options->count() > 0)
            <aside class="md:w-52 md:flex-shrink-0 md:mr-8 mb-8 md:mb-0">
                <ul class="space-y-4">
                    @foreach($options as $option)
                        <li class="mb-2" x-data="{ isOpen: true }">
                            <button x-on:click="isOpen = !isOpen" class="px-4 py-2 bg-gray-200 w-full text-left text-gray-700 flex justify-between items-center">
                                {{ $option->name }}
                                <i class="fas fa-angle-down"
                                x-bind:class="{'rotate-180': isOpen}"></i>
                            </button>
                            <ul class="mt-2 space-y-2" x-show="isOpen">
                                @foreach($option->features as $feature)
                                    <li>
                                        <label class="flex items-center">
                                            <x-checkbox class="mr-2"></x-checkbox>
                                            {{ $feature->description }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </aside>
        @endif

        <div class="md:flex-1">
            @if($products->count() > 0)
                <div class="mb-5">
                    <span>Ordenar por:</span>
                    <select class="select">
                        <option disabled selected>Selecciona una opción</option>
                        <option value="relevance">Relevancia</option>
                        <option value="price">Precio: Menor a Mayor</option>
                        <option value="price_desc">Precio: Mayor a Menor</option>
                    </select>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach($products as $product)
                        <article class="bg-gray-100 p-2 rounded-md shadow-md overflow-hidden">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full rounded-md h-48 object-cover object-center">
                            <div class="p-2">
                                <h2 class="text-lg font-bold text-gray-700 line-clamp-2 min-h-[56px]">{{ $product->name }}</h2>
                                <p class="text-gray-600">Gs. {{ $product->price }}</p>
                                <p class="text-sm text-gray-500 line-clamp-2 mb-3">{{ $product->description }}</p>
                                <a href="" class="btn btn-sm text-center btn-primary w-full text-white">Ver Detalle</a>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center text-gray-500">
                    <h2>No hay productos disponibles para esta sección.</h2>
                </div>
            @endif


        </div>
    </x-container>
</div>
