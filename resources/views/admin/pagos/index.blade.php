@extends('layouts.admin')
@section('content')
    <div class="row">
        <h3 style="color:#001226;"><i class="fas fa-coins"></i> Listado de pagos</h3>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <dv class="card-header">
                    <h3 class="card-title">Pagos registrados</h3>
                    <div class="card-tools">
                        <a href="{{url('admin/pagos/create')}}" class="btn btn-primary">
                            Registrar nuevo
                        </a>
                    </div>
                </dv>
                <div class="card-body">
                    <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                        <thead style="background-color: #001226;color:#fff;">
                        <tr>
                            <td style="text-align: center"><b>Nro</b></td>
                            <td style="text-align: center"><b>Paciente</b></td>
                            <td style="text-align: center"><b>Doctor</b></td>
                            <td style="text-align: center"><b>Fecha de pago</b></td>
                            <td style="text-align: center"><b>Monto</b></td>
                            <td style="text-align: center"><b>Descripción</b></td>
                            <td style="text-align: center"><b>Acciones</b></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $contador = 1;
                        ?>
                        @foreach($pagos as $pago)
                            <tr>
                                <td style="text-align: center">{{$contador++}}</td>
                                <td>{{$pago->paciente->apellidos." ".$pago->paciente->nombres}}</td>
                                <td>{{$pago->doctor->apellidos." ".$pago->doctor->nombres}}</td>
                                <td style="text-align: center">{{$pago->fecha_pago}}</td>
                                <td>{{$pago->monto}}</td>
                                <td>{{$pago->descripcion}}</td>
                                <td style="text-align: center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{url('admin/pagos/'.$pago->id)}}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                        <a href="{{url('admin/pagos/pdf/'.$pago->id)}}" type="button" class="btn btn-warning btn-sm"><i class="bi bi-printer"></i></a>
                                        <a href="{{url('admin/pagos/'.$pago->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                                        <a href="{{url('admin/pagos/'.$pago->id.'/confirm-delete')}}" type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <p><h4>Resumen total del monto de pagos: {{$total_monto}}</h4></p>
                    <script>
                        $(function () {
                            $("#example1").DataTable({
                                "pageLength": 5,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Pagos",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Pagos",
                                    "infoFiltered": "(Filtrado de _MAX_ total Pagos)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Pagos",
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
                                        text:'<button class="btn btn-danger btn-sm btn-block"><i class="bi bi-file-earmark-pdf-fill"></i> PDF</button>',
                                        extend: 'pdf'
                                    },{
                                        text:'<button class="btn btn-info btn-sm btn-block"><i class="bi bi-filetype-csv"></i> CSV</button>',
                                        extend: 'csv'
                                    },{
                                        text:'<button class="btn btn-success btn-sm btn-block"><i class="bi bi-file-earmark-excel-fill"></i> EXCEL</button>',
                                        extend: 'excel'
                                    },{
                                        text:'<button class="btn btn-warning btn-sm btn-block"><i class="bi bi-printer-fill"></i> IMPRIMIR</button>',
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
