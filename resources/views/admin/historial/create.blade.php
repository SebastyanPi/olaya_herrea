@extends('layouts.admin')
@section('content')
    <div class="row">
        <h3 style="color:#001226;"><i class="fas fa-scroll"></i> Registro de un nuevo historial</h3>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h2 class="card-title text-center"><h3><b>Historial Clinico</b></h3></h2>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/historial/create')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form group">
                                            <label for=""><b>Paciente : </b></label> <span class="badge badge-primary" style="font-size: 18px">{{ $event->user->paciente->nombres }} {{ $event->user->paciente->apellidos }}</span>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form group">
                                            <label for=""><b>Carnet Identidad : </b></label> {{ $event->user->paciente->ci }}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form group">
                                            <label for=""><b>Genero : </b></label> @if ($event->user->paciente->genero == "M")
                                                Masculino
                                                @else
                                                Femenino
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @php
                                    use Carbon\Carbon;

                                    $fechaNacimiento = $event->user->paciente->fecha_nacimiento;
                                    $edad = Carbon::parse($fechaNacimiento)->age;
                                @endphp
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form group">
                                            <label for=""><b>Fecha Nacimiento : </b></label> {{ $event->user->paciente->fecha_nacimiento }}

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form group">
                                            <label for=""><b>Edad Actual : </b></label> {{ $edad }}  años
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form group">
                                            <label for=""><b>Celular : </b></label> {{ $event->user->paciente->celular }}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form group">
                                            <label for=""><b>Dirección : </b></label> {{ $event->user->paciente->direccion }}

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form group">
                                            <label for=""><b>Contacto Emergencia : </b></label>  {{ $event->user->paciente->contacto_emergencia }}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form group">
                                            <label for=""><b>Grupo Sanguineo : </b></label> {{ $event->user->paciente->grupo_sanguineo }}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form group">
                                            <label for=""><b>Alergia : </b></label> {{ $event->user->paciente->alergias }}

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form group">
                                            <label for=""><b>Observaciones : </b></label>  {{ $event->user->paciente->observaciones }}
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                                            <label for="">Signos Vitales</label>
                                            <textarea name="signos_vitales" class="form-control" id="editor" cols="20" rows="10" ></textarea>
        

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Diagnostico</label>
                                            <textarea name="diagnostico" class="form-control" id="editor2" cols="20" rows="10" ></textarea>

                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Tratamiento</label>
                                            <textarea name="tratamiento" class="form-control" id="editor3" cols="20" rows="10" ></textarea>
                                      
                                           
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
                                    <button type="submit" class="btn btn-primary">Registrar nuevo</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
