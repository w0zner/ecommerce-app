<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Productos',
        'route' => route('admin.products.index')
    ],
    [
        'name' => 'Nuevo'
    ]
]">

<div class="flex justify-center items-start p-4 pt-1">
    <div class="card-form">
        <div class="card-body">
            <h2 class="card-title">Agregar Productos</h2>

            @livewire('admin.products.product-create')

        </div>
    </div>
</div>


</x-admin-layout>
