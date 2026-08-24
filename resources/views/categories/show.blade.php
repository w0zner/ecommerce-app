<x-app-layout>
    <x-container class="px-4 my-4">
        <div class="breadcrumbs text-sm">
        <ul>
            <li><a href="{{ route('welcome.index') }}">Home</a></li>
            <li><a href="{{route('families.show', $category->family_id)}}">{{ $category->family->name }}</a></li>
            <li><a>{{ $category->name }}</a></li>
        </ul>
        </div>
    </x-container>

    @livewire('filter', ['category_id' => $category->id])
</x-app-layout>
