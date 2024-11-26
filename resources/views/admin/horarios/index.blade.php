@extends('layouts.admin')
@section('content')
    <div class="row">
        <h3 style="color:#001226;"><i class="fas fa-clock"></i> Listado de horarios</h3>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <dv class="card-header">
                    <h3 class="card-title">Horarios registrados</h3>
                    <div class="card-tools">
                        <a href="{{url('admin/horarios/create')}}" class="btn btn-primary">
                            Registrar nuevo
                        </a>
                    </div>
                </dv>
                <div class="card-body">
                    <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                        <thead style="background-color: #001226;color:#fff;">
                        <tr>
                            <td style="text-align: center"><b>Nro</b></td>
                            <td style="text-align: center"><b>Doctor</b></td>
                            <td style="text-align: center"><b>Especialidad</b></td>
                            <td style="text-align: center"><b>Consultorio</b></td>
                            <td style="text-align: center"><b>Día de atención</b></td>
                            <td style="text-align: center"><b>Hora inicio</b></td>
                            <td style="text-align: center"><b>Hora fin</b></td>
                            <td style="text-align: center"><b>Acciones</b></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $contador = 1; ?>
                        @foreach($horarios as $horario)
                            <tr>
                                <td style="text-align: center">{{$contador++}}</td>
                                <td>{{$horario->doctor->nombres ." ".$horario->doctor->apellidos}}</td>
                                <td>{{$horario->doctor->especialidad}}</td>
                                <td>{{$horario->consultorio->nombre." Ubicación: ".$horario->consultorio->ubicacion}}</td>
                                <td>{{$horario->dia}}</td>
                                <td style="text-align: center">{{$horario->hora_inicio}}</td>
                                <td style="text-align: center">{{$horario->hora_fin}}</td>
                                <td style="text-align: center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{url('admin/horarios/'.$horario->id)}}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
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
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Horarios",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Horarios",
                                    "infoFiltered": "(Filtrado de _MAX_ total Horarios)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Horarios",
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
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <dv class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="card-title">Calendario de atención de doctores</h3>
                        </div>
                        <div class="col-md-4">
                            <div style="float: right">
                                <label for="">Consultorios</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="consultorio_id" id="consultorio_select" class="form-control">
                                <option value="">Seleccione un consultorio...</option>
                                @foreach($consultorios as $consultorio)
                                    <option value="{{$consultorio->id}}">{{$consultorio->nombre." - ".$consultorio->ubicacion}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </dv>
                <div class="card-body">
                    <script>
                        $('#consultorio_select').on('change',function () {
                            var consultorio_id = $('#consultorio_select').val();
                            //alert(consultorio_id);

                            if(consultorio_id){
                                $.ajax({
                                   url: "{{url('/admin/horarios/consultorios/')}}" + '/' + consultorio_id,
                                   type: 'GET',
                                   success: function (data) {
                                       $('#consultorio_info').html(data);
                                   },
                                    error: function () {
                                        alert('Error al obtener los datos del consultorio java');
                                    }
                                });
                            }else{
                                $('#consultorio_info').html('');
                            }
                        });
                    </script>
                    <hr>
                    <div id="consultorio_info">

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
