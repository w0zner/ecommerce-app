<x-app-layout>
    <x-container class="px-4 my-4">
        <div class="breadcrumbs text-sm">
        <ul>
            <li><a href="{{ route('welcome.index') }}">Home</a></li>
            <li><a>{{ $family->name }}</a></li>
        </ul>
        </div>
    </x-container>

    @livewire('filter', ['family_id' => $family->id])
</x-app-layout>
