<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Empresa',
        'route' => route('admin.company.index')
    ],
    [
        'name' => 'Nuevo'
    ]
]">

<div class="flex justify-center items-start p-4 pt-1">
    <div class="card-form">
        <div class="card-body">
            <h2 class="card-title">Agregar Datos de la Empresa</h2>
            {{-- <p>A card component has a figure, a body part, and inside body there are title and actions parts</p> --}}

            <form action="{{ route('admin.company.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <fieldset class="fieldset">
                        <legend class="fieldset-legend">Nombre</legend>
                        <input type="text" placeholder="Nombre de la empresa" name="name" value="{{ old('name') }}" class="input w-full border border-gray-300" />
                    </fieldset>
                    </div>
                    <div class="col-span-2">
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Email</legend>
                            <input type="email" placeholder="Email de la empresa" name="email" value="{{ old('email') }}" class="input w-full border border-gray-300" />
                        </fieldset>
                    </div>
                </div>
<div class="grid grid-cols-2 gap-4 mt-6">
                    <div class="col-span-1">
                        <fieldset class="fieldset">
                        <legend class="fieldset-legend">Teléfono</legend>
                        <input type="text" placeholder="Teléfono de la empresa" name="phone" value="{{ old('phone') }}" class="input w-full border border-gray-300" />
                    </fieldset>
                    </div>
                    <div class="col-span-1">
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Whatsapp</legend>
                            <input type="text" placeholder="Whatsapp de la empresa" name="whatsapp" value="{{ old('whatsapp') }}" class="input w-full border border-gray-300" />
                        </fieldset>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-6">
                    <div class="col-span-1">
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Ciudad</legend>
                            <input type="text" placeholder="Ciudad de la empresa" name="city" value="{{ old('city') }}" class="input w-full border border-gray-300" />
                        </fieldset>
                    </div>
                    <div class="col-span-1">
                        <fieldset class="fieldset">
                        <legend class="fieldset-legend">Dirección</legend>
                        <input type="text" placeholder="Dirección de la empresa" name="address" value="{{ old('address') }}" class="input w-full border border-gray-300" />
                    </fieldset>
                    </div>
                </div>


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
