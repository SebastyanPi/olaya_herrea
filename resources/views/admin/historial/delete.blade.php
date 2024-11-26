@extends('layouts.admin')
@section('content')
    <div class="row">
        <h3 style="color:#001226;"><i class="fas fa-scroll"></i> Paciente: {{$historial->paciente->apellidos." ".$historial->paciente->nombres}}</h3>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">¿Esta seguro de eliminar este registro?</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/historial',$historial->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form group">
                                        <label for="">Paciente</label>
                                        <p>{{$historial->paciente->apellidos." ".$historial->paciente->nombres}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form group">
                                        <label for="">Fecha de la cita medica</label>
                                        <p>{{$historial->fecha_visita}}</p>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Descripción de la cita</label>
                                        <p>{!!$historial->detalle!!}</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form group">
                                <a href="{{url('admin/historial')}}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
