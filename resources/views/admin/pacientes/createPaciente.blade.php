@extends('layouts.admin')
@section('content')
    <div class="row">
        <h3 class="container-fluid" style="color:#001226;">Mi Información</h3>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header bg-primary">
                    <h3 class="card-title">Registro de Inicio de Sesión</h3>
                </div>
                <div class="card-body">
                    
                    <form method="POST" action="@if ($paciente->ci){{ route('admin.pacientes.update2',$paciente->id) }}@else{{ route('admin.pacientes.storePaciente')}}@endif" 
                        >
                        @if ($paciente->ci) @method('PUT') @endif


                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Nombre Completo</label> <b></b>
                                    <input type="hidden" name="user_id" value="{{  Auth::user()->id  }}">
                                    <input type="text" value="{{ Auth::user()->name }}" name="nombres" class="form-control" required>
                                    @error('nombres')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Correo</label> <b>*</b>
                                    <input type="text" readonly value="{{Auth::user()->email}}" name="apellidos" class="form-control" required>
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
                    <h3 class="card-title">Información del Paciente</h3>
                </div>
                <div class="card-body">
          
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Nombres</label> <b>*</b>
                                    <input type="text" value="{{ old('nombres', $paciente->nombres ) }}" name="nombres" class="form-control" required>
                                    @error('nombres')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Apellidos</label> <b>*</b>
                                    <input type="text" value="{{ old('apellidos', $paciente->apellidos )}}" name="apellidos" class="form-control" required>
                                    @error('apellidos')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Carnet de Identidad</label> <b>*</b>
                                    <input type="text" value="{{old('ci', $paciente->ci)}}" name="ci" class="form-control" required>
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
                                    <input type="date" value="{{old('fecha_nacimiento', $paciente->fecha_nacimiento)}}" name="fecha_nacimiento" class="form-control" required>
                                    @error('fecha_nacimiento')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Género</label>
                                    <select name="genero" id="" class="form-control">

                                        @if ($paciente->ci)
                                            @if ($paciente->genero == "F")
                                                <option value="F" selected>FEMENINO</option>
                                                <option value="M">MASCULINO</option>
                                            @else
                                                <option value="M"selected >MASCULINO</option>
                                                <option value="F">FEMENINO</option>
                                            @endif
                                        @else

                                            <option value="M">MASCULINO</option>
                                            <option value="F">FEMENINO</option>

                                        @endif
                                 
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Celular</label> <b>*</b>
                                    <input type="number" value="{{old('celular', $paciente->celular)}}" name="celular" class="form-control" required>
                                    @error('celular')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Correo</label> <b>*</b>
                                    <input type="email" value="{{old('correo', $paciente->correo)}}" name="correo" class="form-control" required>
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
                                    <input type="address" value="{{old('direccion', $paciente->direccion)}}" name="direccion" class="form-control" required>
                                    @error('direccion')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Grupo sanguineo</label>
                                    <select name="grupo_sanguineo" id="" class="form-control">

                                        @if ($paciente->ci)
                                            <option value="A+" @if ($paciente->grupo_sanguineo == "A+")
                                                selected
                                            @endif >A+</option>
                                            <option value="A-" @if ($paciente->grupo_sanguineo == "A-")
                                                selected
                                            @endif >A-</option>
                                            <option value="B+" @if ($paciente->grupo_sanguineo == "B+")
                                                selected
                                            @endif >B+</option>
                                            <option value="B-" @if ($paciente->grupo_sanguineo == "B-")
                                                selected
                                            @endif >B-</option>
                                            <option value="O+" @if ($paciente->grupo_sanguineo == "O+")
                                                selected
                                            @endif >O+</option>
                                            <option value="O-" @if ($paciente->grupo_sanguineo == "O-")
                                                selected
                                            @endif >O-</option>   
                                        @else
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>    
                                        @endif
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Alergias</label> <b>*</b>
                                    <input type="text" value="{{old('alergias', $paciente->alergias)}}" name="alergias" class="form-control" required>
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
                                    <input type="number" name="contacto_emergencia" value="{{ old('contacto_emergencia', $paciente->contacto_emergencia) }}" class="form-control" required>
                                    @error('contacto_emergencia')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Tipo de Paciente</label> <b>*</b>
                                    <select class="form-control" name="tipopaciente_id" id="">
                                        @foreach ($tipo_paciente as $item)
                                            <option 
                                            @if ($paciente->tipopaciente_id != "" && $paciente->tipopaciente_id== $item->id)
                                                selected
                                            @endif
                                            value="{{$item->id }}">{{$item->nombre }}</option>
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
                                    <select class="form-control" name="tipoafiliacion_id" id="">
                                        @foreach ($tipo_afiliacion as $item)
                                            <option
                                            @if ($paciente->tipoafiliacion_id != "" && $paciente->tipoafiliacion_id== $item->id)
                                                selected
                                            @endif
                                            value="{{$item->id }}">{{$item->nombre }}</option>
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
                                    <textarea class="form-control" name="observaciones" id="" cols="5" rows="10">{{ old('observaciones', $paciente->observaciones) }}</textarea>
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
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

   
        
@endsection
