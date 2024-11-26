@extends('layouts.admin')
@section('content')
    <div class="row">
        <h3 style="color:#001226;"><i class="fas fa-user-md"></i> Reportes de doctores</h3>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Generar Reporte</h3>
                </div>
                <div class="card-body">
                    <a href="{{url('/admin/doctores/pdf')}}" class="btn btn-success"><i class="bi bi-printer"></i> Listado del personal medico</a>
                </div>
            </div>
        </div>
    </div>
@endsection
