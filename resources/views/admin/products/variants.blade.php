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
        'name' => $product->name,
        'route' => route('admin.products.edit', $product)
    ],
    [
        'name' => $variant->features->pluck('description')->implode(' - ')
    ]
]">

    <form action="">
        @csrf
        <div class="relative mb-6">
            <figure>
                <img class="aspect-[16/9] w-full object-cover object-center" id="imgPreview" src="{{$variant->image}}" alt="">
            </figure>
            <div class="absolute top-8 right-8 bg-gray-200 p-3 rounded-md cursor-pointer shadow-lg">
                <label class="cursor-pointer">
                    <i class="fas fa-camera mr-1"></i>
                    Actualizar imagen
                    <input type="file" name="image" class="hidden" accept="image/*" onchange="previewImage(event, '#imgPreview')">
                </label>
        </div>

        <div class="card shadow-sm bg-base-100">
            <div class="mb-4">
                <fieldset class="fieldset mt-4">
                    <label class="label" for="sku">Código SKU</label>
                    <input name="sku" type="text" placeholder="Ingrese el código SKU" class="input w-full border border-gray-300" />
{{--                     @error('product.sku')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror --}}
                </fieldset>
            </div>
        </div>
    </div>

    </form>


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
