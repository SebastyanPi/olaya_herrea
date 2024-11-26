@extends('layouts.admin')
@section('content')
    <div class="row">
        <h3 style="color:#001226;"><i class="fas fa-clock"></i> Datos del horario</h3>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-10">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos registrado</h3>
                </div>
                <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Doctores</label>
                                    <p>{{$horario->doctor->nombres." ".$horario->doctor->apellidos." - ".$horario->doctor->especialidad}}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Consultorios</label>
                                    <p>{{$horario->consultorio->nombre." - ".$horario->consultorio->ubicacion}}</p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Día</label>
                                    <p>{{$horario->dia}}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Hora Inicio</label>
                                    <p>{{$horario->hora_inicio}}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Hora Final</label>
                                    <p>{{$horario->hora_fin}}</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    <a href="{{url('admin/horarios')}}" class="btn btn-secondary">Volver</a>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"> Eliminar Asignación</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Estas seguro que deseas eliminar esta asignación?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('admin.horarios.destroy',$horario->id)  }}" method="POST">
            @method('DELETE')
            @csrf
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-danger">Si, Eliminar.</button>
            </div>
        </form>
      </div>
    </div>
  </div>

@endsection
