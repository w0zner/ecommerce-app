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
        'name' => 'Nuevo'
    ]
]">

<div class="flex justify-center items-start p-4 pt-12">
    <div class="card-form">
        <div class="card-body">
            <h2 class="card-title">Agregar Subcategorías</h2>

            {{-- <form action="{{ route('admin.subcategories.store') }}" method="POST">
                @csrf

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Categoría</legend>

                    <select name="category_id" class="select input w-full border border-gray-300">
                        <option disabled selected>Elige una categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected($category->id == old('category_id'))>{{$category->name}}</option>
                        @endforeach
                    </select>
                </fieldset>

                <fieldset class="fieldset mt-4">
                    <legend class="fieldset-legend">Nombre</legend>
                    <input type="text" placeholder="Nombre de la subcategoría" name="name" value="{{ old('name') }}" class="input w-full border border-gray-300" />
                </fieldset>

                <div class="card-actions justify-end mt-4">
                    <button class="btn btn-neutral" type="submit">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Guardar
                    </button>
                </div>
            </form> --}}

            @livewire('admin.subcategories.subcategory-create')

        </div>
    </div>
</div>


</x-admin-layout>
