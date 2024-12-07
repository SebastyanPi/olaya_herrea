
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

        
     .estado {
    display: flex;
    align-items: center;
    margin: 10px 0;
}

.estado i {
    margin-right: 10px;
    font-size: 20px;
}

.estado span {
    font-size: 16px;
}

.pendiente {
    color: orange;
}

.asistido {
    color: green;
}

.no-asistido {
    color: red;
}

.aplazado {
    color: blue;
}

    </style>
</head>
<body>
    <div class="header">
 
        <h1>{{$configuracion["nombre"]}}</h1>
        <p>Dirección: {{$configuracion["direccion"]}}, Ciudad - Tel: {{$configuracion["telefono"]}}</p>
    </div>
    
    <div class="content">

        <h2>Lista de Citas Medicas (Rango de Fecha)</h2>
        <table class="info-table">
            <tr>
                <th>Fecha Inicial</th>
                <th>Fecha Final</th>
            </tr>
            <tr>
                <td style="text-align: center">{{ $fecha_inicio }}</td>
                <td style="text-align: center">{{ $fecha_fin }}</td>
            </tr>
        </table>

        <div class="section">
            <h2>Citas Medicas</h2>
            <table class="results-table">
                <tr style="background-color: #e7e7e7">
                    <th>Nro</th>
                    <th>Paciente</th>
                    <th>Doctor</th>
                    <th>Especialidad</th>
                    <th>Fecha de reserva</th>
                    <th>Hora de inicio</th>
                    <th>Hora de fin</th>
                    <th>Estado</th>
                </tr>
                <?php $contador = 1;?>
                @foreach($eventos as $evento)
                    <tr>
                        <td style="text-align: center">{{$contador++}}</td>
                        <td>{{$evento["user"]["paciente"]["nombres"]." ".$evento["user"]["paciente"]["apellidos"]}}</td>
                        <td>{{$evento["doctor"]["nombres"]." ".$evento["doctor"]["apellidos"]}}</td>
                        <td style="text-align: center">{{$evento["doctor"]["especialidad"]}}</td>
                        <td>{{\Carbon\Carbon::parse($evento["start"])->format('Y-m-d')}}</td>
                        <td>{{\Carbon\Carbon::parse($evento["start"])->format('H:i')}}</td>
                        <td>{{\Carbon\Carbon::parse($evento["end"])->format('H:i')}}</td>
                        <td>
                            @if ($evento["status"] == "Pendiente")
                                    <div class="estado pendiente">
                                        <i class="fas fa-clock"></i>  <!-- Ícono de reloj -->
                                        <span>Pendiente</span>
                                    </div>
                                    @elseif ($evento["status"] == "Si asistió")
                                    <div class="estado asistido">
                                        <i class="fas fa-check-circle"></i>  <!-- Ícono de check -->
                                        <span>Si asistió</span>
                                    </div>
                                    @elseif ($evento["status"] == "No asistió")
                                    <div class="estado no-asistido">
                                        <i class="fas fa-times-circle"></i>  <!-- Ícono de cruz -->
                                        <span>No asistió</span>
                                    </div>
                                    @elseif ($evento["status"] == "Aplazado")
                                    <div class="estado aplazado">
                                        <i class="fas fa-calendar-times"></i>  <!-- Ícono de calendario con cruz -->
                                        <span>Aplazado</span>
                                    </div>
                                    @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>
    
    <div class="footer">
        <p>&copy; {{$configuracion["nombre"]}}. Todos los derechos reservados.</p>
    </div>
</body>
</html>

