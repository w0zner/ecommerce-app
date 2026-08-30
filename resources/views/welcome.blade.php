<x-app-layout>
    @push('css')
        <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"
        />
    @endpush

    <!-- Slider main container -->
    <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            @foreach($covers as $cover)
                <div class="swiper-slide">
                    <img src="{{ $cover->image }}" alt="{{ $cover->title }}" class="w-full aspect-[5/1] object-cover object-center">
                </div>
            @endforeach
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <!-- If we need scrollbar -->
        {{-- <div class="swiper-scrollbar"></div> --}}
    </div>

    <x-container>
        <h1 class="text-2xl font-bold text-gray-700 mb-4">
            Ultimos Productos
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($lastProducts as $product)
                <article class="bg-gray-100 p-2 rounded-md shadow-md overflow-hidden">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full rounded-md h-48 object-cover object-center">
                    <div class="p-2">
                        <h2 class="text-lg font-bold text-gray-700 line-clamp-2 min-h-[56px]">{{ $product->name }}</h2>
                        <p class="text-gray-600 font-semibold">Gs. {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500 line-clamp-2 mb-3">{{ $product->description }}</p>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-sm text-center btn-primary w-full text-white">Ver Detalle</a>
                    </div>
                </article>
            @endforeach
        </div>
    </x-container>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
        <script>
            const swiper = new Swiper('.swiper', {
                // Optional parameters
                //direction: 'vertical',
                loop: true,

                autoplay: {
                    delay: 3000,
                },

                // If we need pagination
                pagination: {
                    el: '.swiper-pagination',
                },

                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },

                // And if we need scrollbar
                /*scrollbar: {
                    el: '.swiper-scrollbar',
                },*/
            });
        </script>
    @endpush
</x-app-layout>
