<?php

namespace App\Http\Controllers;

use App\Models\Configuracione;
use App\Models\Historial;
use App\Models\Paciente;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Nette\Utils\first;

class HistorialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $historiales = Historial::with('paciente','doctor')->get();
        return view('admin.historial.index',compact('historiales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($cita_id)
    {
        $event = Event::find($cita_id);
        $pacientes = Paciente::orderBy('apellidos','asc')->get();
        return view('admin.historial.create',compact('pacientes','event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);

        $event = Event::find($request->event_id);
        $event->status = Event::STATUS_ASSISTED;
        $event->save();


        $historial = new Historial();
        $historial->signos_vitales = $request->signos_vitales;
        $historial->diagnostico = $request->diagnostico;
        $historial->tratamiento = $request->tratamiento;
        $historial->event_id = $request->event_id;
        $historial->save();

        return redirect()->route('admin.doctores.citas')
            ->with('mensaje','Se registro el historial medico del paciente de la manera correcta')
            ->with('icono','success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $historial = Historial::find($id);
        return view('admin.historial.show',compact('historial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $historial = Historial::find($id);
        $pacientes = Paciente::orderBy('apellidos','asc')->get();
        return view('admin.historial.edit',compact('historial','pacientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$datos = request()->all();
        //return response()->json($datos);
        $historial = Historial::find($id);
        $historial->signos_vitales = $request->signos_vitales;
        $historial->diagnostico = $request->diagnostico;
        $historial->tratamiento = $request->tratamiento;
        $historial->save();

        $user = Auth::user();
        $ruta = '';
        if($user->hasRole('doctor')){
            $ruta = 'admin.doctores.citas';
        }else{
            $ruta = 'admin.historial.index';
        }

        return redirect()->route($ruta)
            ->with('mensaje','Se actualizo el historial medico del paciente de la manera correcta')
            ->with('icono','success');
      
    }

    /**
     * Remove the specified resource from storage.
     */

    public function confirmDelete($id){
        $historial = Historial::find($id);
        return view('admin.historial.delete',compact('historial'));
    }

    public function destroy($id)
    {
        $historial = Historial::find($id);

        $historial->delete();

        return redirect()->route('admin.historial.index')
            ->with('mensaje','Se elimino el historial clínico de la manera correcta')
            ->with('icono','success');
    }

    public function pdf($id){
        $configuracion = Configuracione::latest()->first();
        $historial = Historial::find($id);

        $pdf = \PDF::loadView('admin.historial.pdf', compact('configuracion','historial'));

        // Incluir la numeración de páginas y el pie de página
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(20, 800, "Impreso por: ".Auth::user()->email, null, 10, array(0,0,0));
        $canvas->page_text(270, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0,0,0));
        $canvas->page_text(450, 800, "Fecha: " . \Carbon\Carbon::now()->format('d/m/Y')." - ".\Carbon\Carbon::now()->format('H:i:s'), null, 10, array(0,0,0));


        return $pdf->stream();
    }


    public function buscar_paciente(Request $request){
        $ci = $request->ci;
        $paciente = Paciente::where('ci',$ci)->first();
        return view('admin.historial.buscar_paciente',compact('paciente'));
    }

    public function imprimir_historial($id){

        $configuracion = Configuracione::latest()->first();
        $paciente = Paciente::where('id',$id)->first();
        $events = $paciente->user->events;

        $pdf = \PDF::loadView('admin.historial.imprimir_historial', compact('configuracion','events','paciente'));

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
