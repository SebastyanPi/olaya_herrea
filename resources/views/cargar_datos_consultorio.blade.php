
<h3><center><b>Horario de atención del consultorio de {{$consultorio->nombre}}</b></center></h3>
<hr>
<table style="font-size: 15px;text-align: center" class="table table-striped table-hover table-sm table-bordered">
    <thead>
    <tr style="text-align: center; background-color:#007bff;color:#ffff;">
        <th>Hora</th>
        <th>Lunes</th>
        <th>Martes</th>
        <th>Miércoles</th>
        <th>Jueves</th>
        <th>Viernes</th>
        <th>Sábado</th>
        <th>Domingo</th>
    </tr>
    </thead>
    <tbody>
    @php
        $horas = ['08:00:00 - 09:00:00','09:00:00 - 10:00:00','10:00:00 - 11:00:00','11:00:00 - 12:00:00','12:00:00 - 13:00:00','13:00:00 - 14:00:00','14:00:00 - 15:00:00','15:00:00 - 16:00:00','16:00:00 - 17:00:00','17:00:00 - 18:00:00','18:00:00 - 19:00:00','19:00:00 - 20:00:00'];
        $diasSemana = ['LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO','DOMINGO'];
    @endphp
    @foreach($horas as $hora)
        @php
            list($hora_inicio,$hora_fin) = explode(' - ',$hora);
        @endphp
        <tr>
            <td style="background-color:#001226;color:#ffff;">{{$hora}}</td>
            @foreach($diasSemana as $dia)
                @php
                    $nombre_doctor = '';
                    foreach ($horarios as $horario){
                        if(strtoupper($horario->dia) == $dia &&
                         $hora_inicio >= $horario->hora_inicio &&
                         $hora_fin <= $horario->hora_fin ){
                         $nombre_doctor = $horario->doctor->nombres." ".$horario->doctor->apellidos;
                         break;
                        }
                    }
                @endphp
                <td>{{$nombre_doctor}}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
