<div>
    <header class="bg-purple-600">
            <x-container class="px-4 py-4">
                <div class="flex justify-between items-center space-x-8">
                    <button class="text-2xl btn btn-ghost">
                        <i class="fas fa-bars text-white"></i>
                    </button>
                    <h1 class="text-white">
                        <a href="/" class="inline-flex flex-col items-end">
                            <span class="text-3xl leading-4 md:leading-6 font-semibold">Ecommerce</span>
                            <span class="text-xs">Tienda Online</span>
                        </a>
                    </h1>
                    <div class="flex-1 hidden md:block">
                        <input type="text" placeholder="Buscar producto" class="input input-sm w-full" />
                    </div>

                    <div class="flex items-center space-x-4 md:space-x-8">
                        <button class="text-2xl btn btn-ghost">
                            <i class="fas fa-user text-white"></i>
                        </button>
                        <button class="text-2xl btn btn-ghost">
                            <i class="fas fa-shopping-cart text-white"></i>
                        </button>
                    </div>
                </div>

                <div class="mt-4 md:hidden">
                    <input type="text" placeholder="Buscar producto" class="input input-sm w-full" />
                </div>
            </x-container>
    </header>
</div>
