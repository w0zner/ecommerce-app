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
        'name' => 'Editar'
    ]
]">

<div class="flex justify-center items-start p-4 pt-1">
    <div class="card-form">
        <div class="card-body">
            <h2 class="card-title">Editar Productos</h2>

            @livewire('admin.products.product-edit', compact('product'))

        </div>
    </div>
</div>


</x-admin-layout>
