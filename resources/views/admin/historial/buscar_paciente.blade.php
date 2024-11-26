@extends('layouts.admin')
@section('content')
    <div class="row">
        <h3 style="color:#001226;"><i class="fas fa-scroll"></i> Busqueda de pacientes: </h3>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Buscar al paciente</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.historial.buscar_paciente')}}" method="get">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Carnet de identidad: </label>
                                    <input type="text" name="ci" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div style="height: 32px;"></div>
                                    <button type="submit" class="btn btn-primary"> <i class="bi bi-search"></i> Buscar </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    @if($paciente)
                        <h4>Información del paciente</h4>
                        <div class="row">
                            <table>
                                <tr>
                                    <td><b>Paciente: </b></td>
                                    <td>{{$paciente->apellidos." ".$paciente->nombres}}</td>
                                </tr>
                                <tr>
                                    <td><b>Carnet de identidad: </b></td>
                                    <td>{{$paciente->ci}}</td>
                                </tr>
                                <tr>
                                    <td><b>Nro de seguro: </b></td>
                                    <td>{{$paciente->nro_seguro}}</td>
                                </tr>
                                <tr>
                                    <td><b>Fecha de nacimiento: </b></td>
                                    <td>{{$paciente->fecha_nacimiento}}</td>
                                </tr>
                            </table>
                        </div>
                        <br>
                        <a target="__blank" href="{{url('/admin/historial/paciente',$paciente->id)}}" class="btn btn-warning">Imprimir historial medico del paciente</a>
                    @else
                        <p>Paciente no registrado</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
