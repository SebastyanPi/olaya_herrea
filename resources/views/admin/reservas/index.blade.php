@extends('layouts.admin')
@section('content')



    <script>
        
          document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var events = @json($eventos);
                console.log(events);
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: 'es',  // Configura el idioma a español
                    headerToolbar:{
                        left: 'prev, next today',
                        center : 'title',
                        right: 'dayGridMonth, timeGridWeek, timeGridDay'
                    },
                initialView: 'dayGridMonth',

                // Configuración del formato de hora en 12 horas (AM/PM)
                    slotLabelFormat: {
                        hour: 'numeric',
                        minute: '2-digit',
                        hour12: true  // Habilitar formato de 12 horas
                    },

                    eventTimeFormat: {
                        hour: 'numeric',
                        minute: '2-digit',
                        hour12: true  // Habilitar formato de 12 horas en los eventos
                    },


                events:events,
                eventRender: function(event, element) {
                    // Mostrar título y descripción completos en un tooltip
                    element.attr('title', event.title + ' - ' + event.description);

                    // Alternativamente, mostrar la descripción en el mismo evento
                    element.find('.fc-title').append("<br/>" + event.description);
                },
                eventClick: function(info) {
                    info.jsEvent.preventDefault();

                    // Configura el contenido del modal
                    document.getElementById('eventTitle').innerText = info.event.title;
                    document.getElementById('eventDescription').innerHTML = info.event.extendedProps.description || 'No hay descripción disponible.';

                    // Obtiene y formatea la hora de inicio
                    var eventStart = info.event.start;
                    var formattedTime = eventStart.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    document.getElementById('eventTime').innerText = formattedTime;

                    // Muestra el modal
                    $('#eventModal').modal('show');
                },
                eventDidMount: function(info) {
                    // Inserta el título y la descripción en formato HTML
                    info.el.querySelector('.fc-event-title').innerHTML = 
                        info.event.title + '<br>' + info.event.extendedProps.description;
                }
                });
                calendar.render();
            });
    </script>

    <style>
.fc-event {
    white-space: normal;
    word-wrap: break-word; /* Permite el ajuste de palabras largas */
    overflow: visible;     /* Asegura que el contenido no se corte */
    padding: 5px;
    font-size: 14px;
}

/* Asegúrate de que la descripción se vea debajo del título */
.fc-event .fc-description {
    display: block;
    color: #555;
    font-size: 12px;
    margin-top: 4px;
}

.fc-toolbar-title {
    font-size: 24px;
    color: #2d2d2d;
    font-weight: bold;
    text-transform: uppercase; /* Cambia a mayúsculas */
}

    </style>


  

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <select type="text" class="form-control" id="mySelect"> 
                    @foreach ($consultorios as $consultorio)
                        <option @if ($consultorio->id == $cons->id)
                            selected
                        @endif value="{{ route('admin.reservas.index', $consultorio->id) }}">{{ $consultorio->nombre }} </option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="col-md-12">
            <ul class="list-group">
                <li class="list-group-item bg-blue-2"><h4>Registrar Citas Medicas <span class="badge badge-primary"></span></h4></li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="text-center">
                                    <img src="{{ url('assets/img/doctor.png') }}" width="30%" alt="">


                                    <table id="horarioTable" class="table-bordered mt-3" width="100%">
                                       <tbody>
                                        <tr class="bg-blue-2">
                                            <th colspan="4">Horario de Atención</th>
                                        </tr>
                                        <tr class="bg-secondary">
                                            <th><small><b>Dia</b></small></th>
                                            <td><small><b>Hora Inicio</b></small></td>
                                            <td><small><b>Hora Fin</b></small></td>
                                            <th><small><b>Doctor</b></small></th>
                                          </tr>
                                          @foreach ($horarios as $horariot)
                                          @if ($horariot->consultorio_id == $cons->id)
                                              <tr>
                                                  <th scope="row" data-dia="{{ $horariot->dia }}">
                                                      <small><b>{{ $horariot->dia }}</b></small>
                                                  </th>
                                                  <td data-hora="{{ \Carbon\Carbon::parse($horariot->hora_inicio)->format('H:i') }}">
                                                      <span class="badge badge-success">{{ \Carbon\Carbon::parse($horariot->hora_inicio)->format('h:i A') }}</span>
                                                  </td>
                                                  <td><span class="badge badge-primary">{{ \Carbon\Carbon::parse($horariot->hora_fin)->format('h:i A') }}</span></td>
                                                  <td><small>{{ $horariot->doctor->nombres }} {{ $horariot->doctor->apellidos }}</small></td>
                                              </tr>
                                          @endif
                                      @endforeach
                                        </tbody>     
                                    </table>
                                   
                                  
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <form action="{{ route('admin.eventos.create') }}" method="POST">
                                @csrf
                            <div class="form-group">
                                <input type="hidden" name="consultorio_id" value="{{ $cons->id }}">
                                <label for="">Consultorio <span class="badge badge-warning" style="font-size: 20px">{{ $cons->nombre }}</span></label>
                            </div>
                            <div class="form-group">
                                <label for="">Doctor</label>

                                <select class="js-example-basic-single" style="width: 100%;" name="doctor_id">
                                    @foreach ($doctores as $doctor)
                                        @if (in_array($doctor->id, $misDoctores))
                                            <option value="{{ $doctor->id }}"> {{ $doctor->nombres }} {{ $doctor->apellidos }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Paciente</label>
                                <select class="js-example-basic-single" style="width: 100%;" name="user_id">
                                    @foreach ($pacientes as $paciente)
                                        <option value="{{ $paciente->user_id }}">{{ $paciente->ci }} - {{ $paciente->nombres }} {{ $paciente->apellidos }}</option>
                                    @endforeach
                                </select>
                            </div>
                          
    
                           
                                <div class="form-group">
                                    <label for="">Fecha de reserva</label>
                                    <input type="date" id="fecha_reserva" value="<?php echo date('Y-m-d');?>" name="fecha_reserva" class="form-control">
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const fechaReservaInput = document.getElementById('fecha_reserva');
    
                                            // Escuchar el evento de cambio en el campo de fecha de reserva
                                            fechaReservaInput.addEventListener('change', function() {
                                                let selectedDate = this.value; // Obtener la fecha seleccionada
    
                                                // Obtener la fecha actual en formato ISO (yyyy-mm-dd)
                                                let today = new Date().toISOString().slice(0, 10);
    
                                                // Verificar si la fecha seleccionada es anterior a la fecha actual
                                                if (selectedDate < today) {
                                                    // Si es así, establecer la fecha seleccionada en null
                                                    this.value = null;
                                                    alert('No se puede reservar en una fecha pasada.');
                                                }
                                            });
                                        });
                                    </script>
                                </div>
    
                                <div class="form-group">
                                    <label for="">Hora de reserva</label>
                                    <input type="time" name="hora_reserva" id="hora_reserva" class="form-control">
                                    @error('hora_reserva')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                    @if( (($message = Session::get('hora_reserva'))) )
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                $('#exampleModal').modal('show');
                                            });
                                        </script>
                                        <small style="color:red">{{$message}}</small>
                                    @endif
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const horaReservaInput = document.getElementById('hora_reserva');
    
                                            horaReservaInput.addEventListener('change', function() {
                                                let selectedTime = this.value; // Obtener el valor de la hora seleccionada
    
                                                
    
                                                // Verificar si la hora seleccionada está fuera del rango permitido
                                                if (selectedTime < '08:00' || selectedTime > '20:00') {
                                                    // Si es así, establecer la hora seleccionada en null
                                                    this.value = null;
                                                    alert('Por favor, seleccione una hora entre las 08:00 y las 20:00.');
                                                }
                                            });
                                        });
                                    </script>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-success btn-block"> Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </li>
              </ul>
        </div>

        <!-- Modal de Bootstrap -->
        <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-blue-2">
                        <h5 class="modal-title" id="eventModalLabel">Detalles de la Cita Medica</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Paciente:</strong> <span id="eventTitle"></span></p>
                        <p><strong>Doctor:</strong> <span id="eventDescription"></span></p>
                        <p><strong>Hora de la Cita:</strong> <span id="eventTime"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-12">
           <div id='calendar'></div>
        </div>
        
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Mapeo de los días de la semana a valores numéricos
            const dayOrder = {
                'lunes': 1,
                'martes': 2,
                'miércoles': 3,
                'jueves': 4,
                'viernes': 5,
                'sábado': 6,
                'domingo': 7
            };
    
            // Seleccionar todas las filas de la tabla
            const rows = Array.from(document.querySelectorAll("#horarioTable tbody tr:not(.bg-blue-2):not(.bg-secondary)"));
    
            // Ordenar las filas según el día y la hora de inicio
            rows.sort((a, b) => {
                const diaA = a.querySelector("[data-dia]").getAttribute("data-dia").toLowerCase();
                const diaB = b.querySelector("[data-dia]").getAttribute("data-dia").toLowerCase();
                const horaA = a.querySelector("[data-hora]").getAttribute("data-hora");
                const horaB = b.querySelector("[data-hora]").getAttribute("data-hora");
    
                // Comparar primero el día, y luego la hora de inicio
                if (dayOrder[diaA] !== dayOrder[diaB]) {
                    return dayOrder[diaA] - dayOrder[diaB];
                }
                return horaA.localeCompare(horaB);
            });
    
            // Reemplazar las filas originales con las ordenadas
            const tbody = document.querySelector("#horarioTable tbody");
            rows.forEach(row => tbody.appendChild(row));
        });
    </script>
  



    <script>
        // Capturar el evento de cambio en el select
        document.getElementById('mySelect').addEventListener('change', function() {
            // Obtener el valor seleccionado
            var url = this.value;
    
            // Verificar si se seleccionó una URL válida
            if (url) {
                // Redireccionar a la URL seleccionada
                window.location.href = url;
            }
        });

        $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
    </script>


@endsection