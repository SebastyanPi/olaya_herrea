<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use App\Models\Doctor;
use App\Models\Event;
use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function index(){
       /*$consultorios = Consultorio::all();
       return view('index',compact('consultorios'));*/
       return redirect('/login');
    }

    public function cargar_datos_consultorios ($id){

        $consultorio = Consultorio::find($id);

        try{
            $horarios = Horario::with('doctor','consultorio')->where('consultorio_id',$id)->get();
            //print_r($horarios);
            return view('cargar_datos_consultorio',compact('horarios','consultorio'));
        }catch (\Exception $exception){
            return response()->json(['mensaje' => 'Error']);
        }
    }

    public function cargar_reserva_doctores($id){
        try{
            $eventos = Event::where('doctor_id',$id)
                ->select('id', 'title', DB::raw('DATE_FORMAT(start, "%Y-%m-%d") as start'), DB::raw('DATE_FORMAT(end, "%Y-%m-%d") as end'), 'color')
                ->get();
            //print_r($horarios);
            return response()->json($eventos);
        }catch (\Exception $exception){
            return response()->json(['mensaje' => 'Error']);
        }
    }
}
