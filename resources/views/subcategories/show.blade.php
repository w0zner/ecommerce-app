<x-app-layout>
    <x-container class="px-4 my-4">
        <div class="breadcrumbs text-sm">
        <ul>
            <li><a href="{{ route('welcome.index') }}">Home</a></li>
            <li><a href="{{route('families.show', $subcategory->category->family->id)}}">{{ $subcategory->category->family->name }}</a></li>
            <li><a href="{{route('categories.show', $subcategory->category->id)}}">{{ $subcategory->category->name }}</a></li>
            <li><a>{{ $subcategory->name }}</a></li>
        </ul>
        </div>
    </x-container>

        @livewire('filter', ['subcategory_id' => $subcategory->id])

</x-app-layout>
