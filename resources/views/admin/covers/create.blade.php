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
<div class="flex justify-center items-start p-4 pt-1">
    <div class="card-form">
        <div class="card-body">
            <h2 class="card-title">Agregar Portada</h2>
            {{-- <p>A card component has a figure, a body part, and inside body there are title and actions parts</p> --}}

            <form action="{{ route('admin.covers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="relative flex justify-center mb-2">
                    <div class="absolute top-8 right-8">
                        <label class="text-black bg-white px-4 py-2 rounded-lg cursor-pointer">
                            <i class="fas fa-camera"></i> Actualizar imagen
                            <input class="hidden" type="file" name="image" accept="image/*" onchange="previewImage(event, '#imgPreview')">
                        </label>
                    </div>

                    <img src="{{ asset('images/no_image_portada.png') }}" id="imgPreview" alt="Portada" class="w-full aspect-[3/1] object-cover object-center rounded-md">
                </div>
                @error('image')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <fieldset class="fieldset mt-4">
                    <legend class="fieldset-legend">Titulo</legend>
                    <input type="text" placeholder="Titulo de la portada" name="title" value="{{ old('title') }}" class="input w-full border border-gray-300" />
                    @error('title')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>


                <fieldset class="fieldset mt-4">
                    <legend class="fieldset-legend">Fecha de inicio</legend>
                    <input type="date" name="start_at" value="{{ old('start_at', now()->format('Y-m-d')) }}" class="input w-full border border-gray-300" />
                    @error('start_at')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="fieldset mt-4">
                    <legend class="fieldset-legend">Fecha fin(Opcional)</legend>
                    <input type="date" name="end_at" value="{{ old('end_at') }}" class="input w-full border border-gray-300" />
                    @error('end_at')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <div class="mt-4 flex space-x-2">
                    <label>
                        <x-input type="radio" name="is_active" value="1" checked></x-input>
                        Activo
                    </label>
                    <label>
                        <x-input type="radio" name="is_active" value="0"></x-input>
                        Inactivo
                    </label>
                    @error('is_active')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="card-actions justify-end mt-4">
                    <button class="btn btn-neutral" type="submit">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Agregar Portada
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
    <script>
        function previewImage(event, querySelector){
            //Recuperamos el input que desencadeno la acción
            let input = event.target;

            //Recuperamos la etiqueta img donde cargaremos la imagen
            let imgPreview = document.querySelector(querySelector);

            // Verificamos si existe una imagen seleccionada
            if(!input.files.length) return

            //Recuperamos el archivo subido
            let file = input.files[0];

            //Creamos la url
            let objectURL = URL.createObjectURL(file);

            //Modificamos el atributo src de la etiqueta img
            imgPreview.src = objectURL;
        }
    </script>
@endpush

</x-admin-layout>
