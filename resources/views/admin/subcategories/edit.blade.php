<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Subcategorías',
        'route' => route('admin.subcategories.index')
    ],
    [
        'name' => 'Editar'
    ]
]">

<div class="flex justify-center items-start p-4 pt-12">
    <div class="card-form">
        <div class="card-body">
            <h2 class="card-title">Editar Subcategorías</h2>

            @livewire('admin.subcategories.subcategory-edit', compact('subcategory'))

        </div>
    </div>
</div>


</x-admin-layout>
