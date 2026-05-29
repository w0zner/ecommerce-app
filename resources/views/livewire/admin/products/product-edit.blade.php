<div>
    <form wire:submit="save">
        <div class="relative flex justify-center mb-2">
            <img src="{{ ($image && !is_string($image)) ? $image->temporaryUrl() : ($product->image_path ? asset('storage/' . $product->image_path) : asset('images/no-image.jpg')) }}" id="imgPreview"  alt="" class="w-full h-96 object-cover rounded object-centermb-6">

            <div class="absolute top-8 right-8">
                <label class="text-black bg-white px-4 py-2 rounded-lg cursor-pointer">
                    <i class="fas fa-camera"></i> Actualizar imagen
                    <input class="hidden" type="file" name="image" accept="image/*" wire:model="image" onchange="preview_image(event, '#imgPreview')">
                </label>
            </div>      
        </div>
        @error('image') 
            <span class="text-red-500 text-xs">{{ $message }}</span> 
        @enderror

        <fieldset class="fieldset mt-4">
            <legend class="fieldset-legend">Código</legend>
            <input wire:model.live="productEdit.sku" type="text" placeholder="SKU" class="input w-full border border-gray-300" />
            @error('productEdit.sku') 
                <span class="text-red-500 text-xs">{{ $message }}</span> 
            @enderror
        </fieldset>

        <fieldset class="fieldset mt-4">
            <legend class="fieldset-legend">Nombre</legend>
            <input wire:model.live="productEdit.name" type="text" placeholder="Nombre del producto" class="input w-full border border-gray-300" />
            @error('productEdit.name') 
                <span class="text-red-500 text-xs">{{ $message }}</span> 
            @enderror
        </fieldset>

        <fieldset class="fieldset mt-4">
            <legend class="fieldset-legend">Descripción</legend>
            <textarea wire:model.live="productEdit.description" class="textarea h-24 input w-full border border-gray-300" placeholder="Descripción"></textarea>
            @error('productEdit.description') 
                <span class="text-red-500 text-xs">{{ $message }}</span> 
            @enderror
        </fieldset>

        <fieldset class="fieldset mt-4">
            <legend class="fieldset-legend">Precio</legend>
            <input wire:model.live="productEdit.price" type="number" placeholder="10000" class="input w-full border border-gray-300" />
            @error('productEdit.price') 
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

            <select wire:model.live="productEdit.subcategory_id" name="category_id" class="select input w-full border border-gray-300">
                <option value="" disabled selected>Elige una subcategoría</option>
                @foreach ($this->subcategories as $category)
                    <option value="{{ $category->id }}" @selected($category->id == old('category_id'))>{{$category->name}}</option>
                @endforeach
            </select>
            @error('productEdit.subcategory_id') 
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