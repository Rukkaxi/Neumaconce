document.addEventListener('DOMContentLoaded', function () {
    var deleteButtons = document.querySelectorAll('.delete-button');

    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            var form = this.closest('form');

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Después de confirmar la eliminación, envía el formulario
                    form.submit();
                }
            });
        });
    });

    // Escucha el evento submit del formulario
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Evita el envío del formulario por defecto

            // Puedes agregar un código aquí para mostrar un mensaje de éxito después de la eliminación
            Swal.fire({
                title: '¡Éxito!',
                text: 'El elemento ha sido eliminado correctamente.',
                icon: 'success'
            });
        });
    });

    // Muestra el mensaje de sesión utilizando SweetAlert si existe
    if (document.querySelector('meta[name="status-message"]')) {
        let statusMessage = document.querySelector('meta[name="status-message"]').getAttribute('content');
        Swal.fire({
            title: 'Éxito',
            text: statusMessage,
            icon: 'success',
            showConfirmButton: false,
            timer: 2000 // Cierra automáticamente el mensaje después de 2 segundos
        });
    }
});
