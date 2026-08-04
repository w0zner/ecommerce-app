<x-admin-layout :breadcrumbs="[
    [
            'name' => 'Dashboard',
            'route' => route('admin.dashboard'),
    ],
    [
            'name' => 'Covers',
    ],
]">
<x-slot name="action">
    <a href="{{ route('admin.covers.create') }}" role="button" class="btn btn-neutral">
        <i class="fa-solid fa-plus"></i> Agregar
    </a>
</x-slot>

</x-admin-layout>