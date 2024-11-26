@extends('layouts.admin')
@section('content')
    <div class="row">
        <h3 style="color:#001226;"><i class="fas fa-edit"></i>Modificar configuración</h3>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/configuraciones',$configuracion->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form group">
                                            <label for="">Nombre de la clinica/hostipal</label> <b>*</b>
                                            <input type="text" value="{{$configuracion->nombre}}" name="nombre" class="form-control" required>
                                            @error('nombre')
                                            <small style="color:red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form group">
                                            <label for="">Dirección</label> <b>*</b>
                                            <input type="address" value="{{$configuracion->direccion}}" name="direccion" class="form-control" required>
                                            @error('direccion')
                                            <small style="color:red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form group">
                                            <label for="">Teléfono</label> <b>*</b>
                                            <input type="text" value="{{$configuracion->telefono}}" name="telefono" class="form-control" required>
                                            @error('telefono')
                                            <small style="color:red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form group">
                                            <label for="">Correo</label> <b>*</b>
                                            <input type="email" value="{{$configuracion->correo}}" name="correo" class="form-control" required>
                                            @error('correo')
                                            <small style="color:red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Logotipo</label>
                                    <input type="file" id="file" name="logo" class="form-control">
                                    <br>
                                    <center>
                                        <output id="list">
                                            <img src="{{url('storage/'.$configuracion->logo)}}" alt="logo" width="100px">
                                        </output>
                                    </center>
                                    <script>
                                        function archivo(evt) {
                                            var files = evt.target.files; // FileList object
                                            // Obtenemos la imagen del campo "file".
                                            for (var i = 0, f; f = files[i]; i++) {
                                                //Solo admitimos imágenes.
                                                if (!f.type.match('image.*')) {
                                                    continue;
                                                }
                                                var reader = new FileReader();
                                                reader.onload = (function (theFile) {
                                                    return function (e) {
                                                        // Insertamos la imagen
                                                        document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="',e.target.result, '" width="70%" title="', escape(theFile.name), '"/>'].join('');
                                                    };
                                                })(f);
                                                reader.readAsDataURL(f);
                                            }
                                        }
                                        document.getElementById('file').addEventListener('change', archivo, false);
                                    </script>
                                </div>
                            </div>
                        </div>


                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    <a href="{{url('admin/configuraciones')}}" class="btn btn-secondary">Cancelar</a>
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
