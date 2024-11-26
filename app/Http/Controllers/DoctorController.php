<?php

namespace App\Http\Controllers;

use App\Models\Configuracione;
use App\Models\Doctor;
use App\Models\Horario;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use Carbon\Carbon;


class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctores = Doctor::with('user')->get();
        return view('admin.doctores.index',compact('doctores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.doctores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'licencia_medica' => 'required',
            'especialidad' => 'required',
            'email'=>'required|max:250|unique:users',
            'password'=>'required|max:250|confirmed',
        ]);

        $usuario = new User();
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->save();

        $doctor = new Doctor();
        $doctor->user_id = $usuario->id;
        $doctor->nombres = $request->nombres;
        $doctor->apellidos = $request->apellidos;
        $doctor->telefono = $request->telefono;
        $doctor->licencia_medica = $request->licencia_medica;
        $doctor->especialidad = $request->especialidad;
        $doctor->save();

        $usuario->assignRole('doctor');

        return redirect()->route('admin.doctores.index')
            ->with('mensaje','Se registro al doctor de la manera correcta')
            ->with('icono','success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.doctores.show',compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.doctores.edit',compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $doctor = Doctor::find($id);

        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'licencia_medica' => 'required',
            'especialidad' => 'required',
            'email'=>'required|max:250|unique:users,email,'.$doctor->user->id,
            'password'=>'nullable|max:250|confirmed',
        ]);

        $doctor->nombres = $request->nombres;
        $doctor->apellidos = $request->apellidos;
        $doctor->telefono = $request->telefono;
        $doctor->licencia_medica = $request->licencia_medica;
        $doctor->especialidad = $request->especialidad;
        $doctor->save();

        $usuario = User::find($doctor->user->id);
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        if($request->filled('password')){
            $usuario->password = Hash::make($request['password']);
        }
        $usuario->save();

        return redirect()->route('admin.doctores.index')
            ->with('mensaje','Se actualizo al doctor de la manera correcta')
            ->with('icono','success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirmDelete($id){
        $num_citas = Event::where('doctor_id',$id)->count();
        $num_horario = Horario::where('doctor_id',$id)->count();
        $num = $num_citas + $num_horario;
        $doctor = Doctor::findOrFail($id);
        return view('admin.doctores.delete',compact('doctor','num'));
    }
    public function destroy($id)
    {
        $doctor = Doctor::find($id);

        //eliminar al usuario asociado
        $user = $doctor->user;
        $user->delete();

        //eliminar al doctor
        $doctor->delete();

        return redirect()->route('admin.doctores.index')
            ->with('mensaje','Se elimino al doctor de la manera correcta')
            ->with('icono','success');
    }

    public function reportes(){
        return view('admin.doctores.reportes');
    }

    public function pdf(){
        $configuracion = Configuracione::latest()->first();
        $doctores = Doctor::all();
        /*$pdf = Pdf::loadView('admin.doctores.pdf', compact('configuracion', 'doctores'))->setPaper('A4', 'portrait');

        // Revisa que haya un usuario autenticado
        $email = Auth::check() ? Auth::user()->email : 'Usuario desconocido';

        // Genera el contenido del PDF sin bucles infinitos
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(20, 800, "Impreso por: " . $email, null, 10, [0, 0, 0]);
        $canvas->page_text(270, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, [0, 0, 0]);
        $canvas->page_text(450, 800, "Fecha: " . Carbon::now()->format('d/m/Y') . " - " . Carbon::now()->format('H:i:s'), null, 10, [0, 0, 0]);


        return $pdf->stream();*/

        $data = [
            'configuracion' => $configuracion,
            'doctores' => $doctores
        ];
        $pdf = Pdf::loadView('admin.doctores.pdf2',$data);
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(20, 800, "Impreso por: ".Auth::user()->email, null, 10, array(0,0,0));
        $canvas->page_text(270, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0,0,0));
        $canvas->page_text(450, 800, "Fecha: " . \Carbon\Carbon::now()->format('d/m/Y')." - ".\Carbon\Carbon::now()->format('H:i:s'), null, 10, array(0,0,0));

        return $pdf->download('Reporte-Medicos.pdf');
    }

    public function list(){
        $eventos = Event::where('doctor_id',Auth::user()->doctor->id)->with('user.paciente')->orderBy('start', 'desc')->get();
        return view('admin.doctores.citas', compact('eventos'));
    }
}
