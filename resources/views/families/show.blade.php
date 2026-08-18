<x-app-layout>
    <div class="mt-8">
        @livewire('filter', ['family_id' => $family->id, 'options' => $options])
    </div>
</x-app-layout>
