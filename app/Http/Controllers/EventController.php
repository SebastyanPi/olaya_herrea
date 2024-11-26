<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Configuracione;
use App\Models\Doctor;
use App\Models\Event;
use App\Models\Consultorio;
use App\Models\Horario;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\Facade\Pdf;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($consultorio_id)
    {
        if($consultorio_id == 0){
            $consul = Consultorio::first(); //todos los
            $eventos = Event::all();
            return redirect()->route('admin.reservas.index', $consul->id);
        }else{
            $pacientes = Paciente::all();

            $horarios = Horario::all(); //todos los

            $consultorios = Consultorio::all();
            $cons = Consultorio::find($consultorio_id);

            $items = Horario::where('consultorio_id',$consultorio_id)->get();
            $misDoctores = [];
            foreach ($items as $item) {
                if(!in_array($item->doctor_id, $misDoctores)){
                    array_push($misDoctores,$item->doctor_id);
                }
            }
            $doctores = Doctor::all();
  

            $configuracion = Configuracione::latest()->first();
       
            $events = Event::where('consultorio_id', $consultorio_id)->get();
            $eventos = [];
            foreach ($events as $evento) {
            
                $buscarpaciente = Paciente::where('user_id', $evento->user->id)->first();
                $title = $buscarpaciente->nombres." ".$buscarpaciente->apellidos;
                $eventos[] = [
                    'id' => $evento->id,
                    'title' => $title,
                    'start' => $evento->start,
                    'end' => $evento->end,
                    'color' => $evento->color,
                    'extendedProps' => [
                        'description' => '<span class="badge badge-success">'.$evento->doctor->nombres.' '.$evento->doctor->apellidos.'</span>'  // HTML adicional para el evento
                    ]
                ];
            }

        
        }
 
        return view('admin.reservas.index', compact('configuracion','eventos','horarios','doctores','misDoctores','cons','pacientes','consultorios'));
    }

    public function view($id){
        $evento = Event::where('id',$id)->with('user.paciente')->first();
        if($evento){
            return view('admin.reservas.show', compact('evento'));
        }
       return redirect()->route('admin.eventos.list')->with([
        'mensaje' => 'Se elimino la reserva de la manera correcta',
        'icono' => 'success',
    ]);;
    }

    public function list(){
        $eventos = Event::with('user.paciente')->orderBy('start', 'desc')->get();
        return view('admin.reservas.list', compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);

        $request->validate([
            'fecha_reserva'=>'required|date',
            'hora_reserva'=>'required|date_format:H:i',
        ]);

        $doctor = Doctor::find($request->doctor_id);
        $fecha_reserva = $request->fecha_reserva;
        $hora_reserva = $request->hora_reserva.':00';

        $dia = date('l',strtotime($fecha_reserva));
        $dia_de_reserva = $this->traducir_dia($dia);

        // Crear una instancia de Carbon con la hora de reserva
        $hora_reserva_carbon = Carbon::createFromFormat('H:i:s', $hora_reserva);

        // Agregar 30 minutos a la hora de reserva para obtener la hora fin

        $hora_fin = $hora_reserva_carbon->copy()->addMinutes(29)->format('H:i:s');


        //valida si existe el horario del doctor
        $horarios = Horario::where('doctor_id',$doctor->id)
                    ->where('dia',$dia_de_reserva)
                    ->where('hora_inicio','<=',$hora_reserva)
                    ->where('hora_fin','>=',$hora_fin)
                    ->exists();

        if(!$horarios){
            return redirect()->back()->with([
                'mensaje' => 'El doctor no esta disponible en ese horario.',
                'icono' => 'error',
                'hora_reserva'=> 'El doctor no esta disponible en ese horario.',
            ]);
        }

        $fecha_hora_reserva = $fecha_reserva." ".$hora_reserva;

        /// valida si existen eventos duplicado
        $eventos_duplicados = Event::where('doctor_id',$doctor->id)
                              ->where('start', $fecha_hora_reserva)
                              ->exists();

                              $eventos_duplicados2 = Event::where('doctor_id',$doctor->id)
                              ->where('end', $fecha_hora_reserva)
                              ->exists();

        if($eventos_duplicados || $eventos_duplicados2){
            return redirect()->back()->with([
                'mensaje' => 'Ya existe una reserva con el mismo doctor en esa fecha y hora.',
                'icono' => 'error',
                'hora_reserva'=> 'Ya existe una reserva con el mismo doctor en esa fecha y hora.',
            ]);
        }

        function getRandomDarkColor() {
            // Genera valores bajos para RGB para asegurarse de que el color sea oscuro
            $red = rand(0, 127);      // Rango de tonos oscuros para el rojo
            $green = rand(0, 127);    // Rango de tonos oscuros para el verde
            $blue = rand(0, 127);     // Rango de tonos oscuros para el azul
        
            // Convierte los valores RGB a hexadecimal y devuelve el color
            return sprintf("#%02X%02X%02X", $red, $green, $blue);
        }

        


        $evento = new Event();
        $evento->title = $request->hora_reserva." ".$doctor->especialidad;
        $evento->start = $request->fecha_reserva." ".$hora_reserva;
        $evento->end = $request->fecha_reserva." ".$hora_fin;
        $evento->color = getRandomDarkColor();
        $evento->user_id = $request->user_id;
        $evento->doctor_id  = $request->doctor_id;
        $evento->consultorio_id   = '1';
        $evento->status = Event::STATUS_PENDING;
        $evento->save();

        return back()
            ->with('mensaje','Se registro la reserva de la cita medica la manera correcta')
            ->with('icono','success');

    }

    private function traducir_dia($dia){
        $dias=[
            'Monday' => 'LUNES',
            'Tuesday' => 'MARTES',
            'Wednesday' => 'MIERCOLES',
            'Thursday' => 'JUEVES',
            'Friday' => 'VIERNES',
            'Saturday' => 'SABADO',
            'Sunday' => 'DOMINGO',
        ];
        return $dias[$dia]??$dias;
    }
    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Event::destroy($id);
        return redirect()->back()->with([
            'mensaje' => 'Se elimino la reserva de la manera correcta',
            'icono' => 'success',
        ]);
    }

    public function reportes(){
        return view('admin.reservas.reportes');
    }

    public function state($id,Request $request){
        $event = Event::find($id);
        $event->status = $request->status;
        $event->save();
        return redirect()->back()->with([
            'mensaje' => 'Se modifico la cita de la manera correcta',
            'icono' => 'success',
        ]);
    }

    public function pdf(){
        $configuracion = Configuracione::latest()->first();
        $eventos = Event::all();

        $data = [
            'configuracion' => $configuracion,
            'eventos' => $eventos
        ];
        $pdf = Pdf::loadView('admin.reservas.pdf', $data);

        // Incluir la numeración de páginas y el pie de página
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(20, 800, "Impreso por: ".Auth::user()->email, null, 10, array(0,0,0));
        $canvas->page_text(270, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0,0,0));
        $canvas->page_text(450, 800, "Fecha: " . \Carbon\Carbon::now()->format('d/m/Y')." - ".\Carbon\Carbon::now()->format('H:i:s'), null, 10, array(0,0,0));

        return $pdf->stream();
    }

    public function pdf_fechas(Request $request){
        //$datos = request()->all();
        //return response()->json($datos);

        $configuracion = Configuracione::latest()->first();

        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');

        $eventos = Event::whereBetween('start',[$fecha_inicio, $fecha_fin])->with('user.paciente')->get();

        $data = [
            'configuracion' => $configuracion,
            'eventos' => $eventos,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin
        ];

        $pdf = Pdf::loadView('admin.reservas.pdf_fechas', $data);

        // Incluir la numeración de páginas y el pie de página
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(20, 800, "Impreso por: ".Auth::user()->email, null, 10, array(0,0,0));
        $canvas->page_text(270, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0,0,0));
        $canvas->page_text(450, 800, "Fecha: " . \Carbon\Carbon::now()->format('d/m/Y')." - ".\Carbon\Carbon::now()->format('H:i:s'), null, 10, array(0,0,0));


        return $pdf->stream();
    }
}
