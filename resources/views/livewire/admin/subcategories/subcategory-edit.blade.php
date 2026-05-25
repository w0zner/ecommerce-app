<div>
    <form wire:submit="save">
    {{--  --}}

    <fieldset class="fieldset">
        <legend class="fieldset-legend">Familia</legend>

        <select wire:model.live="subcategoryEdit.family_id" class="select input w-full border border-gray-300">
            <option value="" disabled selected>Elige una familia</option>
            @foreach ($families as $family)
                <option value="{{ $family->id }}">{{$family->name}}</option>
            @endforeach
        </select>
        @error('subcategoryEdit.family_id') 
    <span class="text-red-500 text-xs">{{ $message }}</span> 
@enderror
    </fieldset>

    <fieldset class="fieldset mt-4">
        <legend class="fieldset-legend">Categoría</legend>

        <select wire:model.live="subcategoryEdit.category_id" name="category_id" class="select input w-full border border-gray-300">
            <option value="" disabled selected>Elige una categoría</option>
            @foreach ($this->categories as $category)
                <option value="{{ $category->id }}" @selected($category->id == old('category_id'))>{{$category->name}}</option>
            @endforeach
        </select>
        @error('subcategoryEdit.category_id') 
    <span class="text-red-500 text-xs">{{ $message }}</span> 
@enderror
    </fieldset>

    <fieldset class="fieldset mt-4">
        <legend class="fieldset-legend">Nombre</legend>
        <input wire:model.live="subcategoryEdit.name" type="text" placeholder="Nombre de la subcategoría" class="input w-full border border-gray-300" />
        @error('subcategoryEdit.name') 
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