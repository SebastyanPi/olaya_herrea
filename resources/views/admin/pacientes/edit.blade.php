@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1></h1>
    </div>

    <div class="row">
        <h3 style="color:#001226;"><i class="fas fa-user-injured"></i> Modificar paciente: {{$paciente->nombres." ".$paciente->apellidos}} </h3>
    </div>


    

    <hr>

    <div class="row">
        <div class="col-md-12">

            <div class="card card-outline card-success">
                <div class="card-header bg-success">
                    <h3 class="card-title">Registro de Inicio de Sesión</h3>
                </div>
                <div class="card-body">
                    
                    <form action="{{ route('admin.pacientes.update2',$paciente->id) }}" method="POST">
        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Nombre Completo</label> <b></b>
                                    <input type="hidden" name="user_id" value="{{ $usuario->id }}">
                                    <input type="text" value="{{ old('name',$usuario->name) }}"  name="name" class="form-control" required>
                                    @error('nombres')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Correo</label> <b>*</b>
                                    <input type="text" readonly  name="email" value="{{ old('email',$usuario->email) }}" class="form-control" required>
                                    @error('apellidos')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                           
                        </div> 

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form group">
                                    <br>
                                    <label for="">Contraseña</label> <b></b>
                                    <div style="position: relative;">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" oninput="validatePassword()">
                                        
                                        <!-- Ícono de ojo -->
                                        <span onclick="togglePasswordVisibility()" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                            <i id="eyeIcon" class="fa fa-eye"></i> <!-- Cambia el ícono aquí -->
                                        </span>
                                    </div>
                                    <!-- Mensaje de error -->
                                            <div id="passwordError" style="color: red; font-size: 0.9em; display: none;">
                                                La contraseña debe tener al menos 8 caracteres.
                                            </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form group">
                                    
                                </div>
                            </div>
                           
                        </div> 
                        <br>
                    
                </div>
            </div>

            <div class="card card-outline card-success">
                <div class="card-header bg-success">
                    <h3 class="card-title">Complete los siguientes campos</h3>
                </div>
                <div class="card-body">
                    
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Nombres</label> <b>*</b>
                                    <input type="text" value="{{$paciente->nombres}}" name="nombres" class="form-control" required>
                                    @error('nombres')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Apellidos</label> <b>*</b>
                                    <input type="text" value="{{$paciente->apellidos}}" name="apellidos" class="form-control" required>
                                    @error('apellidos')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">CI</label> <b>*</b>
                                    <input type="text" value="{{$paciente->ci}}" name="ci" class="form-control" required>
                                    @error('ci')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Fecha de nacimiento</label> <b>*</b>
                                    <input type="date" value="{{$paciente->fecha_nacimiento}}" name="fecha_nacimiento" class="form-control" required>
                                    @error('fecha_nacimiento')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Género</label>
                                    <select name="genero" id="" class="form-control">
                                        @if($paciente->genero=='M')
                                            <option value="M">MASCULINO</option>
                                            <option value="F">FEMENINO</option>
                                        @else
                                            <option value="F">FEMENINO</option>
                                            <option value="M">MASCULINO</option>
                                        @endif

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Celular</label> <b>*</b>
                                    <input type="text" value="{{$paciente->celular}}" name="celular" class="form-control" required>
                                    @error('celular')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Correo</label> <b>*</b>
                                    <input type="email" value="{{$paciente->correo}}" name="correo" class="form-control" required>
                                    @error('correo')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Dirección</label> <b>*</b>
                                    <input type="address" value="{{$paciente->direccion}}" name="direccion" class="form-control" required>
                                    @error('direccion')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Grupo sanguineo</label>
                                    <select name="grupo_sanguineo" id="" class="form-control">
                                        <option value="A+" @selected($paciente->grupo_sanguineo == 'A+')>A+</option>
                                        <option value="A-" @selected($paciente->grupo_sanguineo == 'A-')>A-</option>
                                        <option value="B+" @selected($paciente->grupo_sanguineo == 'B+')>B+</option>
                                        <option value="B-" @selected($paciente->grupo_sanguineo == 'B-')>B-</option>
                                        <option value="O+" @selected($paciente->grupo_sanguineo == 'O+')>O+</option>
                                        <option value="O-" @selected($paciente->grupo_sanguineo == 'O-')>O-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Alergias</label> <b>*</b>
                                    <input type="text" value="{{$paciente->alergias}}" name="alergias" class="form-control" required>
                                    @error('alergias')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Contacto de emergencia</label> <b>*</b>
                                    <input type="text" value="{{$paciente->contacto_emergencia}}" name="contacto_emergencia" class="form-control" required>
                                    @error('contacto_emergencia')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Tipo Paciente</label> <b>*</b>
                                   
                                    <select name="tipopaciente_id" class="form-control" id="">
                                        @foreach ($tipo_paciente as $item)
                                            <option @if ($item->id == $paciente->tipopaciente_id)
                                                selected
                                            @endif  value="{{ $item->id }}">{{ $item->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('tipopaciente_id')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Tipo Afiliación</label> <b>*</b>
                                    <select name="tipoafiliacion_id" class="form-control" id="">
                                        @foreach ($tipo_afiliacion as $item)
                                        <option @if ($item->id == $paciente->tipoafiliacion_id)
                                            selected
                                        @endif value="{{ $item->id }}">{{ $item->nombre }}</option>
                                        @endforeach
                                    </select>
                                
                                    @error('tipoafiliacion_id')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                           
                            
                        </div>
                        <br>
                        <div class="row">   
                            <div class="col-md-12">
                                <div class="form group">
                                    <label for="">Observaciones</label>
                                    <textarea name="observaciones" class="form-control" id="" cols="30" rows="5">{{$paciente->observaciones}}</textarea>
                                    @error('observaciones')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    <a href="{{url('admin/pacientes')}}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Actualizar paciente</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
