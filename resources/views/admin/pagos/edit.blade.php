@extends('layouts.admin')
@section('content')
    <div class="row">
        <h3 style="color:#001226;"><i class="fas fa-coins"></i> Pago del paciente: {{$pago->paciente->apellidos." ".$pago->paciente->nombres}}</h3>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/pagos',$pago->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Paciente</label> <b>*</b>
                                    <select name="paciente_id" id="" class="form-control">
                                        @foreach($pacientes as $paciente)
                                            <option value="{{$paciente->id}}" {{$paciente->id == $pago->paciente_id ? 'selected':''}}>{{$paciente->apellidos." ".$paciente->nombres}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Doctores</label> <b>*</b>
                                    <select name="doctor_id" id="" class="form-control">
                                        @foreach($doctores as $doctore)
                                            <option value="{{$doctore->id}}" {{$doctore->id == $pago->doctor_id ? 'selected':''}} >{{$doctore->apellidos." ".$doctore->nombres." - ".$doctore->especialidad}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Fecha de pago</label> <b>*</b>
                                    <input type="date" name="fecha_pago" value="{{$pago->fecha_pago}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Monto</label> <b>*</b>
                                    <input type="text" name="monto" value="{{$pago->monto}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Descripción</label> <b>*</b>
                                    <input type="text" name="descripcion" value="{{$pago->descripcion}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    <a href="{{url('admin/pagos')}}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
