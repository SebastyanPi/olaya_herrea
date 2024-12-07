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
        
        .content h4 {
            color: #2c3e50;
            font-size: 15px;
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
            font-size: 12px !important;
        }
        
        .info-table th, .info-table td {
            padding: 4px 6px;
            border: 1px solid #ddd;
        }
        
        .info-table th {
            background-color: #3498db;
            color: #fff;
            text-align: left;
        }

        /* Patient and doctor details */
        .info-table2 {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
            background-color: #fff;
            font-size: 12px !important;
        }
        
        .info-table2 th, .info-table2 td {
            padding: 4px 6px;
            border: 1px solid #ddd;
        }
        
        .info-table2 th {
            background-color: #072940;
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


    


        .historial_text{
            font-size: 14px !important;
            text-align: justify;
        }

        .encabezado {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo {
            width: 80px;
            height: auto;
        }
        .detalles {
            margin-left: 15px;
        }
        .nombre-clinica {
            font-size: 18px;
            font-weight: bold;
        }
        .info-clinica {
            font-size: 12px;
            color: #555;
        }
    </style>
</head>
<body>
    @php
            $cadena = public_path()."\storage/".$configuracion["logo"];
            $cadenaReemplazada = str_replace('/', '\\', $cadena);
        @endphp


    <div class="header">
        
        <img src="{{ $cadenaReemplazada }}" alt="">
        <h1>{{$configuracion["nombre"]}} </h1>
        <p>{{ $cadenaReemplazada }}</p>
        <p><b>Dirección:</b> {{ $configuracion["direccion"] }}, - <b>Tel:</b> {{ $configuracion["telefono"] }}</p>
    </div>
    
    <div class="content">
        <h4>Historia Clinica</h4>
        <table class="info-table">
            <tr>
                @php
                    $paciente = $historial['event']['user']['paciente'];
                @endphp
                <th>Paciente</th>
                <td colspan="3">{{ $paciente['nombres']." ".$paciente['apellidos'] }}</td>
                <th>CI</th>
                <td>{{ $paciente['ci'] }}</td>
            </tr>
            <tr>
                <th>Fecha Nacimiento</th>
                <td colspan="3">{{ $paciente['fecha_nacimiento'] }}</td>
               
                <th>Celular</th>
                <td colspan="2">{{ $paciente['celular'] }}</td>
            </tr>
            <tr>
                <th>Correo</th>
                <td colspan="3">{{ $paciente['correo'] }}</td>
                 
                <th>Grupo Sanguineo</th>
                <td>{{ $paciente['grupo_sanguineo'] }}</td>
            </tr>

            <tr>
                <th>Edad</th>
                <td colspan="3">{{ \Carbon\Carbon::parse($paciente['fecha_nacimiento'])->locale('es')->age }}</td>
                <th>Genero</th>
                <td>{{ $paciente['genero'] == "M" ? "Masculino" : "Femenino"; }}</td>
            </tr>

            <tr>
                <th>Direccion</th>
                <td colspan="5">{{ $paciente['direccion'] }}</td>
                
            </tr>
            <tr>
                <th>Alergias</th>
                <td colspan="5">{{ $paciente['alergias'] }}</td>
          
            </tr>
            <tr>
                <th>Obervaciones
                </th>
                <td colspan="5">{{ $paciente['observaciones'] }}</td>
            </tr>

        </table>
        <div class="section">
            <h4>Cita Medica</h4>
            <table class="info-table2">
                @php
                    $cita = $historial['event'];
                @endphp
                <tr>
                    <th>Doctor</th>
                    <td colspan="3">{{ $cita['doctor']['nombres']." ".$cita['doctor']['apellidos'] }}</td>
                    <th>Consultorio</th>
                    <td>{{ $cita['consultorio']['nombre'] }}</td>
                </tr>
                @php $fechaCarbon = \Carbon\Carbon::parse($cita['start']);
                    $fechaCarbonFin = \Carbon\Carbon::parse($cita['end']); @endphp
                <tr>
                    <th>Especialidad</th>
                    <td colspan="3">{{ $cita['doctor']['especialidad'] }}</td>
                   
                    <th>Fecha Cita</th>
                    <td colspan="2">{{$fechaCarbon->translatedFormat('l')  }} {{ $fechaCarbon->day }} {{  $fechaCarbon->translatedFormat('M') }} {{  $fechaCarbon->translatedFormat('Y') }}</td>
                </tr>
     
                <tr>
                    <th>Hora Inicio</th>
                    <td colspan="3"> {{ $fechaCarbon->format('h:i A') }}</td>
                     
                    <th>Hora de Salida</th>
                    <td>{{ $fechaCarbonFin->format('h:i A') }}</td>
                </tr>
    
   
    
            </table>
        </div>
        
        <div class="section">
            <h4>Signos Vitales</h4>
            <p class="historial_text">{{ $historial['signos_vitales'] }}</p>
        </div>

        <div class="section">
            <h4>Diagnostico</h4>
            <p class="historial_text">{{ $historial['diagnostico'] }}</p>
        </div>

        <div class="section">
            <h4>Tratamiento</h4>
            <p class="historial_text">{{ $historial['tratamiento'] }}</p>
        </div>
        
        
       
    </div>
    
    <div class="footer">
        <p>&copy; 2024 {{$configuracion["nombre"]}}. Todos los derechos reservados.</p>
    </div>
</body>
</html>
