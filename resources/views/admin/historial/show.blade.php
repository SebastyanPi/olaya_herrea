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
                    <form action="{{route('admin.historial.update',$historial->id)}}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form group">
                                            <label for=""><b>Paciente : </b></label> <span class="badge badge-primary" style="font-size: 18px">{{ $historial->event->user->paciente->nombres }} {{ $historial->event->user->paciente->apellidos }}</span>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form group">
                                            <label for=""><b>Carnet Identidad : </b></label> {{ $historial->event->user->paciente->ci }}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form group">
                                            <label for=""><b>Genero : </b></label> @if ($historial->event->user->paciente->genero == "M")
                                                Masculino
                                                @else
                                                Femenino
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form group">
                                            <label for=""><b>Fecha Nacimiento : </b></label> {{ $historial->event->user->paciente->fecha_nacimiento }}

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form group">
                                            <label for=""><b>Edad Actual : </b></label> {{ \Carbon\Carbon::parse($historial->event->user->paciente->fecha_nacimiento)->locale('es')->age }} años
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form group">
                                            <label for=""><b>Celular : </b></label> {{ $historial->event->user->paciente->celular }}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form group">
                                            <label for=""><b>Dirección : </b></label> {{ $historial->event->user->paciente->direccion }}

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form group">
                                            <label for=""><b>Contacto Emergencia : </b></label>  {{ $historial->event->user->paciente->contacto_emergencia }}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form group">
                                            <label for=""><b>Grupo Sanguineo : </b></label> {{ $historial->event->user->paciente->grupo_sanguineo }}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form group">
                                            <label for=""><b>Alergia : </b></label> {{ $historial->event->user->paciente->alergias }}

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form group">
                                            <label for=""><b>Observaciones : </b></label>  {{ $historial->event->user->paciente->observaciones }}
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            
                                            <label for="">Signos Vitales</label>
                                            <textarea name="signos_vitales" class="form-control" id="editor" cols="40" rows="5" style="width: 100%;">  {{ $historial->signos_vitales }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Diagnostico</label>
                                            <textarea name="diagnostico" class="form-control" id="editor2" cols="40" rows="5" style="width: 100%;">{{$historial->diagnostico }}</textarea>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Tratamiento</label>
                                            <textarea name="tratamiento" class="form-control" id="editor3" cols="40" rows="5" style="width: 100%;">{{ $historial->tratamiento }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    <a href="{{ route('admin.doctores.citas') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    <a target="__blank" href="{{ route('admin.historial.pdf',$historial->id ) }}" class="btn btn-success"><i class="fas fa-download"></i> </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

