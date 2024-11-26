@extends('layouts.admin')
@section('content')
    <div class="row">
        <h3 style="color:#001226;"><i class="fas fa-door-open"></i> Consultorio: {{$consultorio->nombre}}</h3>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">¿Esta seguro de eliminar este registro?</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/consultorios',$consultorio->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form group">
                                <label for="">Nombre del consultorio</label>
                                <p>{{$consultorio->nombre}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form group">
                                <label for="">Ubicacion</label>
                                <p>{{$consultorio->ubicacion}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form group">
                                <label for="">Capacidad</label>
                                <p>{{$consultorio->capacidad}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form group">
                                <label for="">Teléfono</label>
                                <p>{{$consultorio->telefono}}</p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form group">
                                <label for="">Especialidad</label>
                                <p>{{$consultorio->especialidad}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form group">
                                <label for="">Estado</label>
                                <p>{{$consultorio->estado}}</p>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form group">
                                <a href="{{url('admin/consultorios')}}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-danger">Eliminar consultorio</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
