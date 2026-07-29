<div x-data="{open:false, openMenu:false}">
    <header class="bg-purple-600">
            <x-container class="px-4 py-4">
                <div class="flex justify-between items-center space-x-8">
                    <button class="text-2xl btn btn-ghost" x-on:click="open=true">
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
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button class="text-2xl btn btn-ghost">
                                    <i class="fas fa-user text-white"></i>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                @guest
                                    <div class="px-4 py-2">
                                        <div class="flex justify-center">
                                            <a href="{{route('login')}}" class="btn">Login</a>
                                        </div>
                                        <p class="text-sm text-center">
                                            No tienes cuenta? <a href="{{route('register')}}" class="text-purpel-600 hover:underline">Registrate</a>
                                        </p>
                                    </div>
                                @else

                                    <x-dropdown-link href="{{route('profile.show')}}">
                                        Mi perfil
                                    </x-dropdown-link>
                                    <div class="border-t border-gray-200"></div>
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <x-responsive-nav-link href="{{ route('logout') }}"
                                                    @click.prevent="$root.submit();">
                                            {{-- {{ __('Log Out') }} --}}
                                            Finalizar sesión
                                        </x-responsive-nav-link>
                                    </form>

                                @endguest


                            </x-slot>
                        </x-dropdown>

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

    <div x-show="open" x-on:click="open=false" style="display: none;" class="fixed top-0 left-0 inset-0 bg-black bg-opacity-25 z-10">
    </div>

    <div x-show="open" style="display: none;" class="fixed top-0 left-0 z-20">
        <div class="flex">
            <div class="w-screen md:w-80 h-screen bg-white">
                <div class="bg-purple-600 px-4 py-3 text-white font-semibold">
                    <div class="flex justify-between items-center">
                        <span class="text-lg">
                        Hola
                    </span>
                    <button x-on:click="open=false">
                        <i class="fas fa-times"></i>
                    </button>
                    </div>
                </div>
                <div class="h-[calc(100vh-52px)] overflow-auto">
                    <ul>
                        @foreach ($families as $family)
                            <li x-on:mouseover="openMenu=true" x-on:mouseout="openMenu=false" wire:mouseover="$set('family_id', {{ $family->id }})">
                                <a href="" class="flex items-center justify-between px-4 py-4 text-gray-700 hover:bg-purple-200">
                                    {{ $family->name }}
                                    <i class="fa-solid fa-angle-right"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div x-show="openMenu" x-on:mouseover="openMenu=true" class="w-80 xl:w-[57rem] pt-[52px] hidden md:block">
                <div class="h-[calc(100vh-52px)] overflow-auto bg-white px-6 py-8">
                    <div class="mb-8 flex justify-between items-center">
                        <span class="border-b-[3px] border-lime-400 uppercase text-xl font-semibold pb-1">
                            {{$this->familyName}}
                        </span>

                        <a href="" class="btn">Ver todo</a>
                    </div>
                    <ul class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                        @foreach ($this->categories as $cat)
                            <li>
                                <a href="" class="text-purple-600 font-semibold text-lg">
                                    {{ $cat->name }}
                                </a>
                                <ul class="mt-4 space-y-2">
                                    @foreach ($cat->subcategories as $subcat)
                                        <li>
                                            <a href="" class="text-sm text-gray-700 hover:text-purple-600">
                                                {{ $subcat->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
