<x-admin-layout :breadcrumbs="[
    [
            'name' => 'Dashboard',
            'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Opciones',
        'route' => route('admin.options.index')
    ],
    [
            'name' => 'Editar',
    ],
]">

@livewire('admin.options.manage-options', ['option' => $option])

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
