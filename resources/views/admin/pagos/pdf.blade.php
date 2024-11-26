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
            <img src="{{url('storage/'.$configuracion->logo)}}" alt="logo" width="80px">
        </td>
    </tr>
</table>

<br>

<h3 style="text-align: center"><u>COMPROBANTE DE PAGO - ORIGINAL</u></h3>

<br>

<table border="0" cellpadding="5px" cellspacing="5px" >
    <tr>
        <td width="120px"><b>Sr(es): </b></td>
        <td>{{$pago->paciente->apellidos." ".$pago->paciente->nombres}}</td>
        <td width="150px" rowspan="4"></td>
        <td rowspan="4">
            <div>
                <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="Código QR" width="150px">
            </div>
        </td>
    </tr>
    <tr>
        <td><b>Fecha: </b></td>
        <td>{{$pago->fecha_pago}}</td>
    </tr>
    <tr>
        <td><b>Consultorio: </b></td>
        <td>{{$pago->doctor->especialidad}}</td>
    </tr>
    <tr>
        <td><b>Monto: </b></td>
        <td>{{$pago->monto}}</td>
    </tr>
</table>

<br><br><br>
<table border="0" style="font-size: 9pt">
<tr>
    <td width="210px">
        <p style="text-align: center">
            _________________________ <br>
            <b>Secretaria</b> <br>
            {{Auth::user()->secretarias->apellidos." ".Auth::user()->secretarias->nombres}}
        </p>
    </td>
    <td width="210px"></td>
    <td width="210px">
        <p style="text-align: center">
            _________________________ <br>
            <b>Recibi conforme</b> <br>
        </p>
    </td>
</tr>
</table>

<p>-----------------------------------------------------------------------------------------------------------
-------------</p>

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
            <img src="{{url('storage/'.$configuracion->logo)}}" alt="logo" width="80px">
        </td>
    </tr>
</table>

<br>

<h3 style="text-align: center"><u>COMPROBANTE DE PAGO - COPIA</u></h3>

<br>

<table border="0" cellpadding="5px" cellspacing="5px" >
    <tr>
        <td width="120px"><b>Sr(es): </b></td>
        <td>{{$pago->paciente->apellidos." ".$pago->paciente->nombres}}</td>
        <td width="150px" rowspan="4"></td>
        <td rowspan="4">
            <div>
                <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="Código QR" width="150px">
            </div>
        </td>
    </tr>
    <tr>
        <td><b>Fecha: </b></td>
        <td>{{$pago->fecha_pago}}</td>
    </tr>
    <tr>
        <td><b>Consultorio: </b></td>
        <td>{{$pago->doctor->especialidad}}</td>
    </tr>
    <tr>
        <td><b>Monto: </b></td>
        <td>{{$pago->monto}}</td>
    </tr>
</table>

<br><br><br>
<table border="0" style="font-size: 9pt">
    <tr>
        <td width="210px">
            <p style="text-align: center">
                _________________________ <br>
                <b>Secretaria</b> <br>
                {{Auth::user()->secretarias->apellidos." ".Auth::user()->secretarias->nombres}}
            </p>
        </td>
        <td width="210px"></td>
        <td width="210px">
            <p style="text-align: center">
                _________________________ <br>
                <b>Recibi conforme</b> <br>
            </p>
        </td>
    </tr>
</table>

</body>
</html>
