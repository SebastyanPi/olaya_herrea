@extends('layouts.admin')
@section('content')
    <div class="row">
        <h3 style="color:#001226;"><i class="fas fa-user-md"></i> Cita Medica</h3>
    </div>

    <hr>
    @php
        $fechaCarbon = \Carbon\Carbon::parse($evento->start);
        $fechaCarbonFin = \Carbon\Carbon::parse($evento->end);
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos registrados</h3>
                </div>
                <div class="card-body">


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Paciente</label>
                                    <p>{{$evento->user->paciente->nombres ." ".$evento->user->paciente->apellidos}}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Fecha</label>
                                    <p>{{$fechaCarbon->translatedFormat('l')  }} {{ $fechaCarbon->day }} {{  $fechaCarbon->translatedFormat('M') }} {{  $fechaCarbon->translatedFormat('Y') }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Hora de Incio</label>
                                    <p><span class="badge badge-success" style="font-size: 18px">{{$fechaCarbon->format('h:i A')}}</span></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Hora de Fin</label>
                                    <p><span class="badge badge-primary" style="font-size: 18px">{{$fechaCarbonFin->format('h:i A')}}</span></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Consultorio</label>
                                    <p>{{$evento->consultorio->nombre}}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Medico</label>
                                    <p>{{$evento->doctor->nombres}} {{$evento->doctor->apellidos}}</p>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="">Estado</label>
                                    @if ($evento->status == "Pendiente")
                                    <div class="estado pendiente">
                                        <i class="fas fa-clock"></i>  <!-- Ícono de reloj -->
                                        <span>Pendiente</span>
                                    </div>
                                    @elseif ($evento->status == "Si asistió")
                                    <div class="estado asistido">
                                        <i class="fas fa-check-circle"></i>  <!-- Ícono de check -->
                                        <span>Si asistió</span>
                                    </div>
                                    @elseif ($evento->status == "No asistió")
                                    <div class="estado no-asistido">
                                        <i class="fas fa-times-circle"></i>  <!-- Ícono de cruz -->
                                        <span>No asistió</span>
                                    </div>
                                    @elseif ($evento->status == "Aplazado")
                                    <div class="estado aplazado">
                                        <i class="fas fa-calendar-times"></i>  <!-- Ícono de calendario con cruz -->
                                        <span>Aplazado</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>

                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    @if (auth()->user()->hasRole('doctor'))
                                        <a href="{{ route('admin.doctores.citas') }}" class="btn btn-secondary">Volver</a>
                                    @else
                                    <a href="{{ route('admin.eventos.list') }}" class="btn btn-secondary">Volver</a>
                                    @endif
                                     <!-- Mostrar el botón Eliminar solo si el evento fue creado hoy -->
                   
                                    @if(\Carbon\Carbon::parse($evento->created_at)->isToday())
                                        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('secretaria'))
                                            @if ($evento->historial->count() == 0)
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Eliminar</button>   
                                            @endif

                                            
                         
                                        @endif  
                                    @endif

                                    @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('secretaria')) 
                                        @if ($evento->status != "Si asistió" )
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">Cambiar estado</button>
                                        @endif
                                    @endif 
                                    

                                    @if (auth()->user()->hasRole('doctor') && $evento->status != "Si asistió" && $evento->status != "Aplazado")
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">Cambiar estado</button>
                                    @endif 

                                    


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
            <h5 class="modal-title" id="exampleModalLabel"><h3><b>¿Deseas eliminar esta CITA?</b></h3></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{ route('admin.eventos.destroy',$evento->id) }}" method="POST">
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

         <!-- Modal -->
         <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><h3><b>¿Deseas cambiar el estado de esta CITA?</b></h3></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{ route('admin.eventos.state',$evento->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <select name="status" id="" class="form-control">
                            
                            @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('secretaria'))
                                <option value="Pendiente">Pendiente</option>
                                <option value="Aplazado">Aplazado</option>
                            @endif

                            @if (auth()->user()->hasRole('doctor'))
                                <option value="No asistió">No asistió</option>
                            @endif
                        </select>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Si deseo modificar!</button>
                    </div>
                </form>
            </div>
            </div>
        </div>

@endsection
