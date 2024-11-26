@extends('layouts.admin')
@section('content')
    <div class="row">
        <h3 style="color:#001226;"><i class="fas fa-user-injured"></i> Paciente: {{$paciente->nombres}} {{$paciente->apellidos}}</h3>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos registrados</h3>
                </div>
                <div class="card-body">


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Nombres</label>
                                    <p>{{$paciente->nombres}}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Apellidos</label>
                                    <p>{{$paciente->apellidos}}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">CI</label>
                                    <p>{{$paciente->ci}}</p>
                                </div>
                            </div>
                            
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Fecha de nacimiento</label>
                                    <p>{{$paciente->fecha_nacimiento}}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Género</label>
                                    <p>
                                        @if($paciente->genero=='M') MASCULINO @else FEMENINO @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Celular</label>
                                    <p>{{$paciente->celular}}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Correo</label>
                                    <p>{{$paciente->correo}}</p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Dirección</label>
                                    <p>{{$paciente->direccion}}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Grupo sanguineo</label>
                                    <p>{{$paciente->grupo_sanguineo}}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Alergias</label>
                                    <p>{{$paciente->alergias}}</p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Contacto de emergencia</label>
                                    <p>{{$paciente->contacto_emergencia}}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Tipo de Paciente</label>
                                    <p>{{$paciente->tipopaciente->nombre}}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Tipo de Afiliacion</label>
                                    <p>{{$paciente->tipoafiliacion->nombre}}</p>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form group">
                                    <label for="">Observaciones</label>
                                    <p>{{$paciente->observaciones}}</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    <a href="{{url('admin/pacientes')}}" class="btn btn-secondary">Volver</a>

                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
@endsection
