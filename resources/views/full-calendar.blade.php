@extends('layouts.backend')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/es.js"></script>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Calendario de visitas</div>
                <div id="calendar" class="card-body">

                <script>
                    $(document).ready(function(){
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
                                var title = prompt('Título del evento:');
                                
                                if (title) {
                                    var startFormatted = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                                    var endFormatted = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                                    $.ajax({
                                        url: "/full-calendar/action",
                                        type: "POST",
                                        data: {
                                            title: title,
                                            start: startFormatted,
                                            end: endFormatted,
                                            type: 'add'
                                        },
                                        success: function(data) {
                                            calendar.fullCalendar('refetchEvents');
                                            alert("Se ha ingresado exitosamente.");
                                        },
                                        error: function(err) {
                                            console.error('Error:', err);
                                            alert('Hubo un error al ingresar el evento.');
                                        }
                                    });
                                }
                            },
                            eventResize: function(event, delta) {
                                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
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
                                        alert("Registro actualizado exitosamente.");
                                    },
                                    error: function(err) {
                                        console.error('Error:', err);
                                        alert('Hubo un error al actualizar el evento.');
                                    }
                                });
                            }
                        });
                    });
                </script>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
