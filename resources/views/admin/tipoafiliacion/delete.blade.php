@extends('layouts.admin')
@section('content')
    <div class="row">
        <h3 style="color:#001226;"><i class="fas fa-door-open"></i> Tipo Afiliación: {{$tipoafiliacion->nombre}}</h3>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">¿Esta seguro de eliminar este registro?</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/tipoafiliacion',$tipoafiliacion->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form group">
                                <label for="">Nombre</label>
                                <p>{{$tipoafiliacion->nombre}}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form group">
                                <label for="">Detalles</label>
                                <p>{{$tipoafiliacion->detalle}}</p>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form group">
                                <a href="{{url('admin/tipoafiliacion')}}" class="btn btn-secondary">Cancelar</a>
                                @if ($num == 0)
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
