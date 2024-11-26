@extends('layouts.admin')
@section('content')
    <div class="row">
        <h3 style="color:#001226;"><i class="fas fa-door-open"></i> Tipo Paciente: {{$tipopacientes->nombre}}</h3>
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
                            <div class="col-md-12">
                                <div class="form group">
                                    <label for="">Nombre del consultorio</label>
                                    <p>{{$tipopacientes->nombre}}</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form group">
                                    <label for="">Detalles</label>
                                    <p>{{$tipopacientes->detalle}}</p>
                                </div>
                            </div>
   
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    <a href="{{url('admin/tipopaciente')}}" class="btn btn-secondary">Volver</a>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Eliminar</button>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>

         <!-- Modal -->
         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><h3><b>¿Deseas eliminar este Tipo Paciente?</b></h3></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{ route('admin.tipopaciente.destroy',$tipopacientes->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Si deseo Eliminar!</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
@endsection
