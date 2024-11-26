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
        <img src="" alt="">
        <h1>{{ $configuracion["nombre"] }}</h1>
        <p>Dirección: {{ $configuracion["direccion"] }} - Tel: {{ $configuracion["telefono"] }}</p>
    </div>
   
    <div class="content">
        <h2>Listado de Doctores</h2>
        
        <div class="section">
            <table class="results-table">
                <tr>
                    <th>Nro</th>
                    <th>Apellidos y nombres</th>
                    <th>Teléfono</th>
                    <th>Licencia Medica</th>
                    <th>Especialidad</th>
                </tr>
                <?php $contador = 1;?>
                @foreach ($doctores as $item)
                <tr>
                    <td style="text-align: center">{{$contador++}}</td>
                    <td>{{$item["apellidos"]." ".$item["nombres"]}}</td>
                    <td style="text-align: center">{{$item["telefono"]}}</td>
                    <td>{{$item["licencia_medica"]}}</td>
                    <td>{{$item["especialidad"]}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        
        <div class="section">
            <h3>Observaciones</h3>
            <p style="text-align: justify;font-size:15px;">En el Hospital {{ $configuracion["nombre"] }}, los médicos desempeñan un papel esencial en la atención de nuestros pacientes, brindando servicios de diagnóstico, tratamiento, seguimiento y educación. Colaboran con otros profesionales para ofrecer una atención integral y mantienen registros médicos precisos, cumpliendo altos estándares de calidad y ética.

                Este reporte ratifica su compromiso y dedicación al servicio de la salud en nuestra comunidad</p>
        </div>
    </div>
    
    <div class="footer">
        <p>&copy; 2024 Hospital General. Todos los derechos reservados.</p>
    </div>
</body>
</html>
