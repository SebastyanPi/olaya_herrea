@extends('layouts.admin')
@section('content')
    <div class="row">
        <h3 style="color:#001226;"><i class="fas fa-coins"></i> Pago del paciente {{$pago->paciente->apellidos." ".$pago->paciente->nombres}}</h3>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">¿Esta seguro de eliminar este registro?</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/pagos',$pago->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form group">
                                <label for="">Paciente</label>
                                <p>{{$pago->paciente->apellidos." ".$pago->paciente->nombres}}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form group">
                                <label for="">Doctores</label>
                                <p>{{$pago->doctor->apellidos." ".$pago->doctor->nombres}}</p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form group">
                                <label for="">Fecha de pago</label>
                                <p>{{$pago->fecha_pago}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form group">
                                <label for="">Monto</label>
                                <p>{{$pago->monto}}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form group">
                                <label for="">Descripción</label>
                                <p>{{$pago->descripcion}}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form group">
                                <a href="{{url('admin/pagos')}}" class="btn btn-secondary">Volver</a>
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
