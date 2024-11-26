@extends('layouts.admin')
@section('content')
    <div class="row">
        <h3 style="color:#001226;"><i class="fas fa-user-injured"></i> Registro de un nuevo paciente</h3>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header bg-primary">
                    <h3 class="card-title">Registro de Inicio de Sesión</h3>
                </div>
                <div class="card-body">
                    
                    <form method="POST" action="{{ route('admin.pacientes.store') }}">
        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Nombre de Usuario</label> <b></b>
                                    <input type="text" value="{{ old('name') }}"  name="name" class="form-control" required>
                                    @error('nombres')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Correo</label> <b>*</b>
                                    <input type="text"  name="email" value="{{ old('email') }}" class="form-control" required>
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


            <div class="card card-outline card-primary">
                <div class="card-header bg-primary">
                    <h3 class="card-title">Informacion del Paciente</h3>
                </div>
                <div class="card-body">
          
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Nombres</label> <b>*</b>
                                    <input type="text" value="{{old('nombres')}}" name="nombres" class="form-control" required>
                                    @error('nombres')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Apellidos</label> <b>*</b>
                                    <input type="text" value="{{old('apellidos')}}" name="apellidos" class="form-control" required>
                                    @error('apellidos')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Carnet de Identidad</label> <b>*</b>
                                    <input type="text" value="{{old('ci')}}" name="ci" class="form-control" required>
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
                                    <input type="date" value="{{old('fecha_nacimiento')}}" name="fecha_nacimiento" class="form-control" required>
                                    @error('fecha_nacimiento')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Género</label>
                                    <select name="genero" id="" class="form-control">
                                        <option value="M">MASCULINO</option>
                                        <option value="F">FEMENINO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Celular</label> <b>*</b>
                                    <input type="number" value="{{old('celular')}}" name="celular" class="form-control" required>
                                    @error('celular')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Correo</label> <b>*</b>
                                    <input type="email" value="{{old('correo')}}" name="correo" class="form-control" required>
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
                                    <input type="address" value="{{old('direccion')}}" name="direccion" class="form-control" required>
                                    @error('direccion')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Grupo sanguineo</label>
                                    <select name="grupo_sanguineo" id="" class="form-control">
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Alergias</label> <b>*</b>
                                    <input type="text" value="{{old('alergias')}}" name="alergias" class="form-control" required>
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
                                    <input type="number" name="contacto_emergencia" class="form-control" value="{{old('contacto_emergencia')}}" required>
                                    @error('contacto_emergencia')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Tipo de Paciente</label> <b>*</b>
                                    <select name="tipopaciente_id" class="form-control" id="">
                                        @foreach ($tipo_paciente as $item)
                                            <option value="{{$item->id }}">{{$item->nombre }}</option>
                                        @endforeach 
                                    </select>
                                    @error('tipopaciente_id')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Tipo de Afiliacion</label> <b>*</b>
                                    <select name="tipoafiliacion_id" class="form-control" id="">
                                        @foreach ($tipo_afiliacion as $item)
                                            <option value="{{$item->id }}">{{$item->nombre }}</option>
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
                                    <textarea name="observaciones" class="form-control" id="" cols="30" rows="5">{{old('observaciones')}}</textarea>
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
                                    <button type="submit" class="btn btn-primary">Registrar paciente</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
