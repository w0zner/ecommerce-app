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
                <div class="bg-gray-100 p-4 rounded-md shadow-md overflow-hidden">
                    <img src="{{ $product->image }}" alt="{{ $product->title }}" class="w-full aspect-[1/1] object-cover object-center">
                </div>
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