<div>
    <form wire:submit="save">
        {{-- <figure class="image-container position-relative d-inline-block mb-3 w-full" style="width: fit-content; max-height: 24rem;">
            <img src="{{ $image ? $image->temporaryUrl() : asset('images/no-image.jpg') }}" style="object-fit: cover;" class="rounded-box h-96" alt="">
        </figure>
        <button type="button" 
            id="btn-update-image" 
            class="btn btn-sm btn-dark position-absolute bottom-0 w-full end-0 m-3 shadow-sm"
            style="z-index: 10;"
            title="Actualizar imagen">
            <i class="fas fa-camera me-1"></i>Actualizar
        </button>
        <input type="file" class="hidden" accept="image/*" wire:model="image"> --}}

        <div class="relative flex justify-center mb-2">
                    <img src="{{ $image ? $image->temporaryUrl() : asset('images/no-image.jpg') }}" id="imgPreview"  alt="" class="w-full h-96 object-cover rounded object-centermb-6">

                    <div class="absolute top-8 right-8">
                        <label class="text-black bg-white px-4 py-2 rounded-lg cursor-pointer">
                            <i class="fas fa-camera"></i> Actualizar imagen
                            <input class="hidden" type="file" name="image" accept="image/*" wire:model="image" onchange="preview_image(event, '#imgPreview')">
                        </label>


                    </div>
                    
                    {{-- <div class="absolute bottom-8 right-8">
                            <a href="{{ Storage::url($post->image_path) }}" download class="text-black bg-white px-4 py-2 rounded-lg cursor-pointer">
                                Descargar
                            </a>
                    </div> --}}
                    {{-- <div class="absolute bottom-8 right-8">
                        <flux:button href="{{ route('admin.posts.download', $post) }}" icon="arrow-down-tray" as="a">
                            Descargar
                        </flux:button>
                    </div> --}}
                </div>
                @error('image') 
                    <span class="text-red-500 text-xs">{{ $message }}</span> 
                @enderror

        <fieldset class="fieldset mt-4">
            <legend class="fieldset-legend">Código</legend>
            <input wire:model.live="product.sku" type="text" placeholder="SKU" class="input w-full border border-gray-300" />
            @error('product.sku') 
                <span class="text-red-500 text-xs">{{ $message }}</span> 
            @enderror
        </fieldset>

        <fieldset class="fieldset mt-4">
            <legend class="fieldset-legend">Nombre</legend>
            <input wire:model.live="product.name" type="text" placeholder="Nombre del producto" class="input w-full border border-gray-300" />
            @error('product.name') 
                <span class="text-red-500 text-xs">{{ $message }}</span> 
            @enderror
        </fieldset>

        <fieldset class="fieldset mt-4">
            <legend class="fieldset-legend">Descripción</legend>
            <textarea wire:model.live="product.description" class="textarea h-24 input w-full border border-gray-300" placeholder="Descripción"></textarea>
            @error('product.description') 
                <span class="text-red-500 text-xs">{{ $message }}</span> 
            @enderror
        </fieldset>

        <fieldset class="fieldset mt-4">
            <legend class="fieldset-legend">Precio</legend>
            <input wire:model.live="product.price" type="number" placeholder="10000" class="input w-full border border-gray-300" />
            @error('product.price') 
                <span class="text-red-500 text-xs">{{ $message }}</span> 
            @enderror
        </fieldset>

         <fieldset class="fieldset mt-4">
            <legend class="fieldset-legend">Familia</legend>

            <select wire:model.live="family_id" class="select input w-full border border-gray-300">
                <option value="" disabled selected>Elige una familia</option>
                @foreach ($families as $family)
                    <option value="{{ $family->id }}">{{$family->name}}</option>
                @endforeach
            </select>
            @error('family_id') 
                <span class="text-red-500 text-xs">{{ $message }}</span> 
            @enderror
        </fieldset>

        <fieldset class="fieldset mt-4">
            <legend class="fieldset-legend">Categoría</legend>

            <select wire:model.live="category_id" name="category_id" class="select input w-full border border-gray-300">
                <option value="" disabled selected>Elige una categoría</option>
                @foreach ($this->categories as $category)
                    <option value="{{ $category->id }}" @selected($category->id == old('category_id'))>{{$category->name}}</option>
                @endforeach
            </select>
            @error('category_id') 
                <span class="text-red-500 text-xs">{{ $message }}</span> 
            @enderror
        </fieldset>

        <fieldset class="fieldset mt-4">
            <legend class="fieldset-legend">Subcategoría</legend>

            <select wire:model.live="product.subcategory_id" name="category_id" class="select input w-full border border-gray-300">
                <option value="" disabled selected>Elige una subcategoría</option>
                @foreach ($this->subcategories as $category)
                    <option value="{{ $category->id }}" @selected($category->id == old('category_id'))>{{$category->name}}</option>
                @endforeach
            </select>
            @error('product.subcategory_id') 
                <span class="text-red-500 text-xs">{{ $message }}</span> 
            @enderror
        </fieldset>

        <div class="card-actions justify-end mt-4">
            <button class="btn btn-neutral" type="submit">
                <i class="fa-solid fa-floppy-disk"></i>
                Guardar
            </button>
        </div>
    </form>
</div>