<x-admin-layout :breadcrumbs="[
    [
            'name' => 'Dashboard',
            'route' => route('admin.dashboard'),
    ],
    [
            'name' => 'Portadas',
            'route' => route('admin.covers.index'),
    ],
    [
            'name' => 'Nuevo',
    ],
]">
<div class="flex justify-center items-start p-4 pt-12">
    <div class="card-form">
        <div class="card-body">
            <h2 class="card-title">Agregar Portada</h2>
            {{-- <p>A card component has a figure, a body part, and inside body there are title and actions parts</p> --}}

            <form action="{{ route('admin.covers.store') }}" method="POST">
                @csrf

                <figure>
                    <img src="{{ asset('images/no_image_portada.png') }}" alt="Portada" class="w-full aspect-[3/1] object-cover object-center">
                </figure>

                <fieldset class="fieldset mt-4">
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