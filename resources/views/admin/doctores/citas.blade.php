@extends('layouts.admin')
@section('content')
    <div class="row">
        <h3 style="color:#001226;"><i class="fas fa-user-md"></i> Listado de citas medicas</h3>
    </div>

    <hr>



    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <dv class="card-header">
                    <h3 class="card-title">Citas Medicas Registradas</h3>
                </dv>
                <div class="card-body">
                    <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                        <thead style="background-color: #001226;color:#fff;">
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
                            <td style="text-align: center"><b>Registrar</b></td>
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
                                    
                                    <a href="{{ route('admin.historial.show',$evento->historial[0]->id ) }}" class="btn btn-warning btn-sm"><i class="fas fa-sticky-note"></i> HC</a>
                                    <a target="__blank" href="{{ route('admin.historial.pdf',$evento->historial[0]->id ) }}" class="btn btn-success btn-sm"><i class="fas fa-download"></i> </a>
                                    @endif
                                   
                                </td>
                               
                                <td style="text-align: center">
                                    
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('admin.eventos.view',$evento->id) }}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                    </div>
                                </td>

                                <td class="text-center">
                                    @if ($evento->historial->count() == 0)
                                        @if ($evento->status == "Pendiente")
                                        <a href="{{ route('admin.historial.create',$evento->id) }}" class="btn btn-primary"><i class="fas fa-arrow-right"></i></a>
                                        @endif
                                    @endif
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
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Doctores",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Doctores",
                                    "infoFiltered": "(Filtrado de _MAX_ total Doctores)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Doctores",
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
