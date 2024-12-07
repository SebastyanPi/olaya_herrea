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
            {{$configuracion["nombre"]}} <br>
            {{$configuracion["direccion"]}} <br>
            {{$configuracion["telefono"]}} <br>
            {{$configuracion["correo"]}} <br>
        </td>
        <td width="330px"></td>
        <td>
            <img src="{{}}" alt="logo" width="80px">
        </td>
    </tr>
</table>

<br>

<h2 style="text-align: center"><u>Listado de todas las resevas medicas</u></h2>

<br>

<table class="table table-bordered table-sm table-striped">
    <thead>
    <tr style="background-color: #e7e7e7">
        <th>Nro</th>
        <th>Doctor</th>
        <th>Especialidad</th>
        <th>Fecha de reserva</th>
        <th>Hora de reserva</th>
    </tr>
    </thead>
    <tbody>
    <?php $contador = 1;?>
    @foreach($eventos as $evento)
        <tr>
            <td style="text-align: center">{{$contador++}}</td>
            <td>{{$evento["doctor"]["nombres"]." ".$evento["doctor"]["apellidos"]}}</td>
            <td style="text-align: center">{{$evento["doctor"]["especialidad"]}}</td>
            <td>{{\Carbon\Carbon::parse($evento["start"])->format('Y-m-d')}}</td>
            <td>{{\Carbon\Carbon::parse($evento["start"])->format('H:i')}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Hospital</title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 20px;
            line-height: 1.6;
        }
        
        /* Header */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .header img {
            width: 80px;
            height: auto;
        }
        
        .header h1 {
            color: #3498db;
            font-size: 24px;
            margin: 5px 0;
        }
        
        .header p {
            color: #555;
            font-size: 14px;
        }
        
        /* Main content */
        .content {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        
        .content h2 {
            color: #2c3e50;
            font-size: 20px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
            margin-top: 0;
        }
        
        /* Patient and doctor details */
        .info-table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
            background-color: #fff;
        }
        
        .info-table th, .info-table td {
            padding: 8px 12px;
            border: 1px solid #ddd;
        }
        
        .info-table th {
            background-color: #3498db;
            color: #fff;
            text-align: left;
        }
        
        /* Report sections */
        .section {
            margin-top: 15px;
        }
        
        .section h3 {
            color: #2c3e50;
            font-size: 18px;
            margin-bottom: 10px;
        }
        
        .section p {
            margin: 5px 0;
        }
        
        /* Footer */
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
        
        /* Table of results */
        .results-table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
            font-size: 14px;
        }
        
        .results-table th, .results-table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        
        .results-table th {
            background-color: #2c3e50;
            color: #fff;
        }
        
        .results-table tr:nth-child(even) {
            background-color: #f3f3f3;
        }
    </style>
</head>
<body>
    <div class="header">

        <h1>{{$configuracion["nombre"]}}</h1>
        <p>Dirección: {{$configuracion["direccion"]}}, Ciudad - Tel: {{$configuracion["telefono"]}}</p>
    </div>
    
    <div class="content">
        <h2>Citas Medicas</h2>

        <div class="section">
            <h3>Resultados de Laboratorio</h3>
            <table class="results-table">
                <tr>
                    <th>Nro</th>
                    <th>Doctor</th>
                    <th>Especialidad</th>
                    <th>Fecha de reserva</th>
                    <th>Hora de reserva</th>
                </tr>
                <?php $contador = 1;?>
                @foreach($eventos as $evento)
                    <tr>
                        <td style="text-align: center">{{$contador++}}</td>
                        <td>{{$evento["doctor"]["nombres"]." ".$evento["doctor"]["apellidos"]}}</td>
                        <td style="text-align: center">{{$evento["doctor"]["especialidad"]}}</td>
                        <td>{{\Carbon\Carbon::parse($evento["start"])->format('Y-m-d')}}</td>
                        <td>{{\Carbon\Carbon::parse($evento["start"])->format('H:i')}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        
        <div class="section">
            <h3>Observaciones</h3>
            <p>Se recomienda que el paciente mantenga una dieta balanceada y evite el consumo de alimentos altos en grasas saturadas. Programar una cita de seguimiento en dos semanas.</p>
        </div>
    </div>
    
    <div class="footer">
        <p>&copy; {{$configuracion["nombre"]}}. Todos los derechos reservados.</p>
    </div>
</body>
</html>

