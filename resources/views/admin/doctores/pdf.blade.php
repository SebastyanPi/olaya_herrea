<?php
/**
 * Created by PhpStorm.
 * User: HILARIWEB
 * Date: 11/7/2024
 * Time: 15:55
 */
?>
    <!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
<table border="0" style="font-size: 8pt">
    <tr>
        <td style="text-align: center">
            {{$configuracion->nombre}} <br>
            {{$configuracion->direccion}} <br>
            {{$configuracion->telefono}} <br>
            {{$configuracion->correo}} <br>
        </td>
        <td width="330px"></td>
        <td>
            <img src="{{url('storage/app/public/'.$configuracion->logo)}}" alt="logo" width="80px">
        </td>
    </tr>
</table>

<br>

<h2 style="text-align: center"><u>Listado del personal medico</u></h2>

<br>

<table class="table table-bordered table-sm table-striped">
    <thead>
    <tr style="background-color: #e7e7e7">
        <th>Nro</th>
        <th>Apellidos y nombres</th>
        <th>Teléfono</th>
        <th>Licencia Medica</th>
        <th>Especialidad</th>
    </tr>
    </thead>
    <tbody>
    <?php $contador = 1;?>
    @foreach($doctores as $doctore)
        <tr>
            <td style="text-align: center">{{$contador++}}</td>
            <td>{{$doctore->apellidos." ".$doctore->nombres}}</td>
            <td style="text-align: center">{{$doctore->telefono}}</td>
            <td>{{$doctore->licencia_medica}}</td>
            <td>{{$doctore->especialidad}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
