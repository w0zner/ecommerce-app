<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorías',
        'route' => route('admin.categories.index')
    ],
    [
        'name' => 'Nuevo'
    ]
]">

<div class="flex justify-center items-start p-4 pt-12">
    <div class="card-form">
        <div class="card-body">
            <h2 class="card-title">Agregar Categorías</h2>
            {{-- <p>A card component has a figure, a body part, and inside body there are title and actions parts</p> --}}

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Familia</legend>

                    <select name="family_id" class="select input w-full border border-gray-300">
                        <option disabled selected>Elige una familia</option>
                        @foreach ($families as $family)
                            <option value="{{ $family->id }}" @selected($family->id == old('family_id'))>{{$family->name}}</option>
                        @endforeach
                    </select>
                </fieldset>

                <fieldset class="fieldset mt-4">
                    <legend class="fieldset-legend">Nombre</legend>
                    <input type="text" placeholder="Nombre de la categoría" name="name" value="{{ old('name') }}" class="input w-full border border-gray-300" />
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
