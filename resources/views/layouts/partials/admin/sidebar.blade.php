@php
    $links = [
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-gauge-high',
            'route' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
        ],
        [
            'header' => 'Adminstrar Página'
        ],
        [
            'name' => 'Empresa',
            'icon' => 'fa-solid fa-industry',
            'route' => route('admin.company.index'),
            'active' => request()->routeIs('admin.company.index'),
        ],
        [
            'name' => 'Familias',
            'icon' => 'fa-solid fa-box-open',
            'route' => route('admin.families.index'),
            'active' => request()->routeIs('admin.families.index'),
        ],
        [
            'name' => 'Categorias',
            'icon' => 'fa-solid fa-layer-group',
            'route' => route('admin.categories.index'),
            'active' => request()->routeIs('admin.categories.index'),
        ],
        [
            'name' => 'Subcategorias',
            'icon' => 'fa-solid fa-table-list',
            'route' => route('admin.subcategories.index'),
            'active' => request()->routeIs('admin.subcategories.index'),
        ],
        [
            'name' => 'Productos',
            'icon' => 'fa-solid fa-box',
            'route' => route('admin.products.index'),
            'active' => request()->routeIs('admin.products.index'),
        ],
        [
            'name' => 'Opciones',
            'icon' => 'fa-solid fa-sliders',
            'route' => route('admin.options.index'),
            'active' => request()->routeIs('admin.options.index'),
        ],
        [
            'name' => 'Portadas',
            'icon' => 'fa-solid fa-images',
            'route' => route('admin.covers.index'),
            'active' => request()->routeIs('admin.covers.*'),
        ],
        [
            'header' => 'Ordenes y Envíos'
        ],
        [
            'name' => 'Ordenes',
            'icon' => 'fa-solid fa-shopping-cart',
            'route' => route('admin.orders.index'),
            'active' => request()->routeIs('admin.orders.*'),
        ],
    ];
@endphp

<aside id="top-bar-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-[100dvh] transition-transform -translate-x-full sm:translate-x-0"
        :class="{
            'translate-x-0 ease-out': sidebarOpen,
            '-translate-x-full ease-in': !sidebarOpen
        }"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-white border-e border-default">
           {{--  <a href="https://flowbite.com/" class="flex items-center ps-2.5 mb-5">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 me-3" alt="Flowbite Logo" />
                <span class="self-center text-lg text-heading font-semibold whitespace-nowrap">Flowbite</span>
            </a> --}}
            <div class="pb-5"></div>
            <ul class="pt-10 space-y-2 font-medium">
                @foreach ($links as $link)
                    <li>
                        @isset($link['header'])
                            <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase ">
                                {{ $link['header'] }}
                            </div>
                        @else
                            <a href="{{ $link['route'] }}"
                                class="flex items-center px-2 py-1.5 text-body rounded-lg hover:bg-blue-100 hover:text-blue-900 group {{ $link['active'] ? 'bg-blue-100 text-blue-900' : '' }}">
                                <i class="{{ $link['icon'] }} text-gray-700"></i>
                                <span class="ms-3">{{ $link['name'] }}</span>
                            </a>
                        @endisset
                    </li>
                @endforeach
            </ul>
        </div>
</aside>
