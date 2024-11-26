@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Mis Citas</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <dv class="card-header">
                    <h3 class="card-title">Mis Citas</h3>
                </dv>
                <div class="card-body">
                    <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                        <thead style="background-color: #c0c0c0">
                        <tr>
                            <td style="text-align: center"><b>C.I</b></td>
                            <td style="text-align: center"><b>Paciente</b></td>
                            <td style="text-align: center">Fecha</td>
                            <td style="text-align: center"><b>Hora de Inicio</b></td>
                            <td style="text-align: center"><b>Hora de Fin</b></td>
                            <td style="text-align: center"><b>Consultorio</b></td>
                            <td style="text-align: center"><b>Medico</b></td>
                            <td style="text-align: center"><b>Estado</b></td>
                            <td style="text-align: center"><b>Historia Clinica</b></td>
                            <td style="text-align: center"><b>Acciones</b></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $contador = 1; ?>
                        @foreach($eventos as $evento)

                            @php
                                $fechaCarbon = \Carbon\Carbon::parse($evento->start);
                                $fechaCarbonFin = \Carbon\Carbon::parse($evento->end);
                            @endphp
                            <tr>
                                <td style="text-align: center">{{$evento->user->paciente->ci}}</td>
                                <td>{{$evento->user->paciente->nombres ." ".$evento->user->paciente->apellidos}}</td>
                                <td>{{$fechaCarbon->translatedFormat('l')  }} {{ $fechaCarbon->day }} {{  $fechaCarbon->translatedFormat('M') }} {{  $fechaCarbon->translatedFormat('Y') }}</td>
                                <td><span class="badge badge-success" style="font-size: 18px">{{$fechaCarbon->format('h:i A')}}</span></td>
                                <td><span class="badge badge-primary" style="font-size: 18px">{{$fechaCarbonFin->format('h:i A')}}</span></td>
                                <td>{{$evento->consultorio->nombre}}</td>
                                <td>{{$evento->doctor->nombres}} {{$evento->doctor->apellidos}}</td>
                                <td>
                                    @if ($evento->status == "Pendiente")
                                    <div class="estado pendiente" style="font-size: 10px">
                                        <i class="fas fa-clock"></i>  <!-- Ícono de reloj -->
                                        <span>Pendiente</span>
                                    </div>
                                    @elseif ($evento->status == "Si asistió")
                                    <div class="estado asistido" style="font-size: 10px">
                                        <i class="fas fa-check-circle"></i>  <!-- Ícono de check -->
                                        <span>Si asistió</span>
                                    </div>
                                    @elseif ($evento->status == "No asistió")
                                    <div class="estado no-asistido" style="font-size: 10px">
                                        <i class="fas fa-times-circle"></i>  <!-- Ícono de cruz -->
                                        <span>No asistió</span>
                                    </div>
                                    @elseif ($evento->status == "Aplazado")
                                    <div class="estado aplazado" style="font-size: 10px">
                                        <i class="fas fa-calendar-times"></i>  <!-- Ícono de calendario con cruz -->
                                        <span>Aplazado</span>
                                    </div>
                                    @endif
                                    
                                </td>

                                <td class="text-center">
                                    @if ($evento->historial->count() > 0)

                                    <a target="__blank" href="{{ route('admin.historial.pdf',$evento->historial[0]->id ) }}" class="btn btn-success btn-sm"><i class="fas fa-download"></i> </a>
                                    @endif
                                </td>
                                <td style="text-align: center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <form action="{{url('/admin/eventos/destroy',$evento->id)}}"
                                              id="formulario{{$evento->id}}" onclick="preguntar{{$evento->id}}(event)" method="post">
                                            @csrf
                                            @method('DELETE')
                                            @if ($evento->status == "Pendiente" && \Carbon\Carbon::parse($evento->created_at)->isToday())
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            @endif
                                         
                                        </form>
                                        <script>
                                            function preguntar{{$evento->id}}(event) {
                                                event.preventDefault();
                                                Swal.fire({
                                                    title: "¿Esta seguro de eliminar este registro de reserva?",
                                                    text: "Si eliminar este registro, otro usuario podra reservar en este mismo horario.",
                                                    icon: "question",
                                                    showDenyButton: true,
                                                    showCancelButton: false,
                                                    confirmButtonText: "Eliminar",
                                                    denyButtonText: `Cancelar`
                                                }).then((result) => {
                                                    /* Read more about isConfirmed, isDenied below */
                                                    if (result.isConfirmed) {
                                                        var form = $('#formulario{{$evento->id}}');
                                                        form.submit();
                                                    }
                                                });
                                            }
                                        </script>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <script>
                        $(function () {
                            $("#example1").DataTable({
                                "pageLength": 5,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Reservas",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Reservas",
                                    "infoFiltered": "(Filtrado de _MAX_ total Reservas)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Reservas",
                                    "loadingRecords": "Cargando...",
                                    "processing": "Procesando...",
                                    "search": "Buscador:",
                                    "zeroRecords": "Sin resultados encontrados",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Ultimo",
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    }
                                },
                                "responsive": true, "lengthChange": true, "autoWidth": false,
                                buttons: [{
                                    extend: 'collection',
                                    text: 'Reportes',
                                    orientation: 'landscape',
                                    buttons: [{
                                        text: 'Copiar',
                                        extend: 'copy',
                                    }, {
                                        extend: 'pdf'
                                    },{
                                        extend: 'csv'
                                    },{
                                        extend: 'excel'
                                    },{
                                        text: 'Imprimir',
                                        extend: 'print'
                                    }
                                    ]
                                },
                                    {
                                        extend: 'colvis',
                                        text: 'Visor de columnas',
                                        collectionLayout: 'fixed three-column'
                                    }
                                ],
                            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
