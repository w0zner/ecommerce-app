<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Familias',
        'route' => route('admin.families.index')
    ],
    [
        'name' => 'Nuevo'
    ]
]">

{{-- <x-slot name="action">
    <a href="{{ route('admin.families.create') }}" role="button" class="btn btn-neutral">
        <i class="fa-solid fa-plus"></i> Agregar
    </a>
</x-slot> --}}


    {{-- <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-md border border-default">
        Hola min-h-screen
    </div> --}}
<div class="flex justify-center items-start p-4 pt-12">
    <div class="card-form">
        <div class="card-body">
            <h2 class="card-title">Agregar Familias</h2>
            {{-- <p>A card component has a figure, a body part, and inside body there are title and actions parts</p> --}}

            <form action="{{ route('admin.families.store') }}" method="POST">
                @csrf
                <fieldset class="fieldset">
                <legend class="fieldset-legend">Nombre</legend>
                <input type="text" placeholder="Nombre de la familia" name="name" value="{{ old('name') }}" class="input w-full border border-gray-300" />
                </fieldset>

                <div class="card-actions justify-end mt-4">
                    <button class="btn btn-neutral" type="submit">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


</x-admin-layout>
