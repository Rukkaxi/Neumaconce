@extends('layouts.backend')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card w-100"> 
                <div class="card-header text-center">Notificaciones</div>
                <div class="card-body w-100">
                    <div id="notifications">
                        <!-- Aquí se mostrarán las notificaciones -->
                    </div>
                    <button id="clearNotifications" class="btn btn-danger mt-3">Limpiar Notificaciones</button>
                </div> 
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        function fetchNotifications() {
            $.ajax({
                url: '/notifications/fetch',
                type: 'GET',
                success: function(response) {
                    let notifications = '';
                    response.forEach(notification => {
                        notifications += `<div class="alert alert-info">${notification.message}</div>`;
                    });
                    $('#notifications').html(notifications);

                    // Marcar notificaciones como leídas
                    markNotificationsAsRead();
                },
                error: function(err) {
                    console.error('Error:', err);
                    Swal.fire('¡Error!', 'Hubo un error al cargar las notificaciones.', 'error');
                }
            });
        }

        function markNotificationsAsRead() {
            $.ajax({
                url: '/notifications/mark-read',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log('Notificaciones marcadas como leídas');
                },
                error: function(err) {
                    console.error('Error:', err);
                    Swal.fire('¡Error!', 'Hubo un error al marcar las notificaciones como leídas.', 'error');
                }
            });
        }

        $('#clearNotifications').click(function() {
            $.ajax({
                url: '/notifications/clear',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#notifications').html('');
                    Swal.fire('¡Éxito!', 'Notificaciones limpiadas exitosamente.', 'success');
                },
                error: function(err) {
                    console.error('Error:', err);
                    Swal.fire('¡Error!', 'Hubo un error al limpiar las notificaciones.', 'error');
                }
            });
        });

        fetchNotifications();
    });
</script>

@endsection
