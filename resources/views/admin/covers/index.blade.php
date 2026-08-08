<x-admin-layout :breadcrumbs="[
    [
            'name' => 'Dashboard',
            'route' => route('admin.dashboard'),
    ],
    [
            'name' => 'Covers',
    ],
]">
<x-slot name="action">
    <a href="{{ route('admin.covers.create') }}" role="button" class="btn btn-neutral">
        <i class="fa-solid fa-plus"></i> Agregar
    </a>
</x-slot>

@if($covers->isNotEmpty())
    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-md border border-default">
        <table class="w-full text-sm text-left rtl:text-right text-body">
            <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-default-medium">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Título
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Fecha de inicio
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Estado
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium text-center">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($covers as $cover)
                    <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            {{ $cover->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $cover->title }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $cover->start_at->format('d-m-Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-center badge badge-neutral">{{ $cover->is_active ? 'Activo' : 'Inactivo' }}</div>
                        </td>
                        <td class="flex justify-center px-6 py-4 text-center">
                            <a href="{{ route('admin.covers.edit', $cover) }}" role="button" class="btn-accion-editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.covers.destroy', $cover) }}" method="post" onsubmit="confirmDelete(event)">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-accion-eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $covers->links() }}
    </div>
@else
    <div class="flex items-start sm:items-center p-4 text-sm text-heading rounded-base bg-neutral-secondary-medium border border-default-medium" role="alert">
        <svg class="w-4 h-4 me-2 shrink-0 mt-0.5 sm:mt-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
        <p><span class="font-medium me-1">Información!</span> No hay Portadas guardadas.</p>
    </div>
@endif

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
