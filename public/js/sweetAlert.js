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
                    form.submit();
                }
            });
        });
    });

    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            Swal.fire({
                title: '¡Éxito!',
                text: 'El elemento ha sido eliminado correctamente.',
                icon: 'success'
            });
        });
    });

    if (document.querySelector('meta[name="status-message"]')) {
        let statusMessage = document.querySelector('meta[name="status-message"]').getAttribute('content');
        Swal.fire({
            title: 'Éxito',
            text: statusMessage,
            icon: 'success',
            showConfirmButton: false,
            timer: 2000
        });
    }

    // Confirmación para el botón Comprar
    var purchaseButton = document.getElementById('purchase-button');
    purchaseButton.addEventListener('click', function (event) {
        event.preventDefault();
        var form = document.getElementById('purchase-form');

        Swal.fire({
            title: '¿Confirmar compra?',
            text: "¿Estás seguro de que deseas realizar esta compra?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, comprar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
