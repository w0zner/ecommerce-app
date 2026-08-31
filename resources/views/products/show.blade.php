<x-app-layout>
    <x-container class="px-4 my-4">
        <div class="breadcrumbs text-sm">
        <ul>
            <li><a href="{{ route('welcome.index') }}">Home</a></li>
            <li><a href="{{route('families.show', $product->subcategory->category->family->id)}}">{{ $product->subcategory->category->family->name }}</a></li>
            <li><a href="{{route('categories.show', $product->subcategory->category->id)}}">{{ $product->subcategory->category->name }}</a></li>
            <li><a>{{ $product->subcategory->name }}</a></li>
        </ul>
        </div>
    </x-container>

    @livewire('products.add-to-cart', ['product' => $product])


</x-app-layout>
