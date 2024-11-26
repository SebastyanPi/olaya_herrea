@extends('layouts.admin')
@section('content')
    <div class="row">
        <h3 style="color:#001226;"><i class="fas fa-coins"></i> Registro de un nuevo pago</h3>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/pagos/create')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Paciente</label> <b>*</b>
                                    <select name="paciente_id" id="" class="form-control">
                                    @foreach($pacientes as $paciente)
                                       <option value="{{$paciente->id}}">{{$paciente->apellidos." ".$paciente->nombres}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Doctores</label> <b>*</b>
                                    <select name="doctor_id" id="" class="form-control">
                                        @foreach($doctores as $doctore)
                                            <option value="{{$doctore->id}}">{{$doctore->apellidos." ".$doctore->nombres." - ".$doctore->especialidad}}</option>
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
                                    <input type="date" name="fecha_pago" value="<?php echo date('Y-m-d')?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Monto</label> <b>*</b>
                                    <input type="text" name="monto" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Descripción</label> <b>*</b>
                                    <input type="text" name="descripcion" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    <a href="{{url('admin/pagos')}}" class="btn btn-secondary">Cancelar</a>
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
