<x-admin-layout :breadcrumbs="[
    [
            'name' => 'Dashboard',
            'route' => route('admin.dashboard'),
    ],
    [
            'name' => 'Opciones',
    ],
]">

{{-- <x-slot name="action">
    <a wire:click="$set('openModal', true)" role="button" class="btn btn-neutral">
        <i class="fa-solid fa-plus"></i> Agregar
    </a>
</x-slot> --}}


@livewire('admin.options.manage-options')

@push('js')
    <script>
        function confirmDelete(event) {
            event.preventDefault();
            Swal.fire({
            title: "Esta seguro de eliminar el registro?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#097969",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) event.target.submit();
        });
        }        
    </script>
@endpush

</x-admin-layout>
