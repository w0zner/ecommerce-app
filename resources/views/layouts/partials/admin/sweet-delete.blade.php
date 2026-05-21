<script>
    function confirmDelete(event) {
        event.preventDefault();
        Swal.fire({
            title: "¿Estás seguro de eliminar el registro?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#097969",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) event.target.closest('form').submit();
        });
    }
</script>