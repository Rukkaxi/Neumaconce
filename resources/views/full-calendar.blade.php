@extends('layouts.backend')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/es.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card w-100">
                <div class="card-header text-center">Calendario de visitas</div>
                <div id="calendar-container" class="card-body w-100">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ingresar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Agregar/Editar Evento</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="eventForm">
                    <div class="form-group">
                        <label for="eventTitle">Título del evento</label>
                        <input type="text" class="form-control" id="eventTitle" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="eventStart">Fecha de inicio</label>
                        <input type="date" class="form-control" id="eventStart" name="start" required>
                    </div>
                    <div class="form-group">
                        <label for="eventEnd">Fecha de fin</label>
                        <input type="date" class="form-control" id="eventEnd" name="end" required>
                    </div>
                    <input type="hidden" id="eventId" name="id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger mr-auto" id="deleteEvent" style="display:none;">Eliminar evento</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="saveEvent">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div aria-live="polite" aria-atomic="true" class="position-fixed end-0 pt-3" style="z-index: 11;">
    <div class="toast" id="eventToast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fa fa-flag-o me-2" aria-hidden="true"></i>
            <strong class="me-auto">Nueva Notificación</strong>
            <small class="text-muted">ahora</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Se ha agregado un nuevo evento.
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#calendar').fullCalendar({
            locale: 'es',
            editable: true,
            header: {
                left: 'prev, next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: '/full-calendar',
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {
                $('#eventForm')[0].reset();
                $('#eventId').val('');
                $('#eventStart').val(moment(start).format('YYYY-MM-DD'));
                $('#eventEnd').val(moment(end).format('YYYY-MM-DD'));
                $('#deleteEvent').hide();
                $('#ingresar').modal('show');
            },
            eventResize: function(event, delta) {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD');
                var title = event.title;
                var id = event.id;

                $.ajax({
                    url: "/full-calendar/action",
                    type: "POST",
                    data: {
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success: function(response) {
                        calendar.fullCalendar('refetchEvents');
                        Swal.fire('¡Éxito!', 'Registro actualizado exitosamente.', 'success');
                    },
                    error: function(err) {
                        console.error('Error:', err);
                        Swal.fire('¡Error!', 'Hubo un error al actualizar el evento.', 'error');
                    }
                });
            },
            eventDrop: function(event, delta) {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD');
                var title = event.title;
                var id = event.id;

                $.ajax({
                    url: "/full-calendar/action",
                    type: "POST",
                    data: {
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success: function(response) {
                        calendar.fullCalendar('refetchEvents');
                        Swal.fire('¡Éxito!', 'Registro actualizado exitosamente.', 'success');
                    },
                    error: function(err) {
                        console.error('Error:', err);
                        Swal.fire('¡Error!', 'Hubo un error al actualizar el evento.', 'error');
                    }
                });
            },
            eventClick: function(event) {
                $('#eventId').val(event.id);
                $('#eventTitle').val(event.title);
                $('#eventStart').val(moment(event.start).format('YYYY-MM-DD'));
                $('#eventEnd').val(moment(event.end).format('YYYY-MM-DD'));
                $('#deleteEvent').show();
                $('#ingresar').modal('show');
            }
        });

        var headerHeight = $('header').outerHeight();
        $('.position-fixed').css('top', headerHeight + 'px');

        function showToast() {
            $('#eventToast').toast('show');
        }

        $('#saveEvent').click(function() {
            var id = $('#eventId').val();
            var title = $('#eventTitle').val();
            var start = $('#eventStart').val();
            var end = $('#eventEnd').val();
            var type = id ? 'update' : 'add';

            if (title && start && end) {
                $.ajax({
                    url: "/full-calendar/action",
                    type: "POST",
                    data: {
                        id: id,
                        title: title,
                        start: start,
                        end: end,
                        type: type
                    },
                    success: function(data) {
                        calendar.fullCalendar('refetchEvents');
                        $('#ingresar').modal('hide');
                        Swal.fire('¡Éxito!', 'El evento ha sido guardado exitosamente.', 'success');
                        showToast();
                        updateNotificationCount();
                    },
                    error: function(err) {
                        console.error('Error:', err);
                        Swal.fire('¡Error!', 'Hubo un error al guardar el evento.', 'error');
                    }
                });
            } else {
                Swal.fire('¡Error!', 'Todos los campos son obligatorios.', 'error');
            }
        });

        $('#deleteEvent').click(function() {
            var id = $('#eventId').val();

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
                    $.ajax({
                        url: "/full-calendar/action",
                        type: "POST",
                        data: {
                            id: id,
                            type: 'delete'
                        },
                        success: function(response) {
                            calendar.fullCalendar('refetchEvents');
                            $('#ingresar').modal('hide');
                            Swal.fire('¡Eliminado!', 'El evento ha sido eliminado.', 'success');
                            updateNotificationCount();
                        },
                        error: function(err) {
                            console.error('Error:', err);
                            Swal.fire('¡Error!', 'Hubo un error al eliminar el evento.', 'error');
                        }
                    });
                }
            })
        });

        function updateNotificationCount() {
            $.ajax({
                url: "/notifications/count",
                type: "GET",
                success: function(data) {
                    if (data.count > 0) {
                        $('#notificationCount').text(data.count).show();
                    } else {
                        $('#notificationCount').hide();
                    }
                },
                error: function(err) {
                    console.error('Error:', err);
                }
            });
        }

        $('.toast').toast({
            autohide: true,
            delay: 2000
        });

        updateNotificationCount();
    });
</script>

@endsection
