<?php

namespace App\Http\Controllers;


use App\Models\Paciente;
use App\Models\Event;
use App\Models\TipoAfiliacion;
use App\Models\TipoPaciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipo_afiliacion = TipoAfiliacion::all();
        $tipo_paciente = TipoPaciente::all();
        $pacientes = Paciente::all();
        return view('admin.pacientes.index',compact('pacientes','tipo_afiliacion','tipo_paciente'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipo_afiliacion = TipoAfiliacion::all();
        $tipo_paciente = TipoPaciente::all();
        return view('admin.pacientes.create', compact('tipo_afiliacion','tipo_paciente'));
    }
    public function createPaciente($id)
    {
        $tipo_afiliacion = TipoAfiliacion::all();
        $tipo_paciente = TipoPaciente::all();
        $paciente = Paciente::where('user_id',$id)->first();
        if(!$paciente){
            $paciente = new Paciente();
            $paciente->nombres = "";
            $paciente->apellidos = "";
            $paciente->ci = "";
            $paciente->fecha_nacimiento = "";
            $paciente->genero = "";
            $paciente->celular = "";
            $paciente->correo = "";
            $paciente->direccion = "";
            $paciente->grupo_sanguineo = "";
            $paciente->alergias = "";
            $paciente->contacto_emergencia = "";
            $paciente->observaciones = "";
            $paciente->tipopaciente_id = "";
            $paciente->tipoafiliacion_id = "";
        }
        return view('admin.pacientes.createPaciente',compact('paciente','tipo_afiliacion','tipo_paciente'));
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
            'ci' => 'required|unique:pacientes',
            'fecha_nacimiento' => 'required',
            'genero' => 'required',
            'celular' => 'required',
            'correo'=>'required|max:250|unique:pacientes',
            'direccion' => 'required',
            'grupo_sanguineo' => 'required',
            'alergias' => 'required',
            'contacto_emergencia' => 'required',
            'email'=>'required|max:250|unique:users',
            'password'=>'required|max:250',
            'tipopaciente_id' => 'required',
            'tipoafiliacion_id' => 'required', 
        ]);

        $usuario = new User();
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->save();

        $paciente = new Paciente();
        $paciente->nombres = $request->nombres;
        $paciente->apellidos = $request->apellidos;
        $paciente->ci = $request->ci;
        $paciente->fecha_nacimiento = $request->fecha_nacimiento;
        $paciente->genero = $request->genero;
        $paciente->celular = $request->celular;
        $paciente->correo = $request->correo;
        $paciente->direccion = $request->direccion;
        $paciente->grupo_sanguineo = $request->grupo_sanguineo;
        $paciente->alergias = $request->alergias;
        $paciente->contacto_emergencia = $request->contacto_emergencia;
        $paciente->observaciones = $request->observaciones;
        $paciente->user_id = $usuario->id;

        $paciente->tipopaciente_id = $request->tipopaciente_id;
        $paciente->tipoafiliacion_id = $request->tipoafiliacion_id;
        $paciente->save();

        $usuario->assignRole('usuario');

        return redirect()->route('admin.pacientes.index')
            ->with('mensaje','Se registro al paciente de la manera correcta')
            ->with('icono','success');

    }

    public function storePaciente(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);

        if($request->password != ""){
            $usuario = User::findOrFail($request->user_id);
            // Actualizar la contraseña encriptada
            $usuario->password = Hash::make($request->input('password'));
            $usuario->save();
        }
   
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'ci' => 'required|unique:pacientes',
            'fecha_nacimiento' => 'required',
            'genero' => 'required',
            'celular' => 'required',
            'correo'=>'required|max:250|unique:pacientes',
            'direccion' => 'required',
            'grupo_sanguineo' => 'required',
            'alergias' => 'required',
            'contacto_emergencia' => 'required',
            'user_id' => 'required',
            'tipopaciente_id' => 'required',
            'tipoafiliacion_id' => 'required', 
        ]);

        $paciente = new Paciente();
        $paciente->nombres = $request->nombres;
        $paciente->apellidos = $request->apellidos;
        $paciente->ci = $request->ci;
        $paciente->fecha_nacimiento = $request->fecha_nacimiento;
        $paciente->genero = $request->genero;
        $paciente->celular = $request->celular;
        $paciente->correo = $request->correo;
        $paciente->direccion = $request->direccion;
        $paciente->grupo_sanguineo = $request->grupo_sanguineo;
        $paciente->alergias = $request->alergias;
        $paciente->contacto_emergencia = $request->contacto_emergencia;
        $paciente->observaciones = $request->observaciones;
        $paciente->user_id = $request->user_id;
        $paciente->tipopaciente_id = $request->tipopaciente_id;
        $paciente->tipoafiliacion_id = $request->tipoafiliacion_id;
        $paciente->save();

        /*return redirect()->route('admin.pacientes.index')
            ->with('mensaje','Se registro al paciente de la manera correcta')
            ->with('icono','success');*/

            return back()
            ->with('mensaje','Se actualizo al paciente de la manera correcta')
            ->with('icono','success');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $paciente = Paciente::findOrFail($id);
        $tipo_afiliacion = TipoAfiliacion::all();
        $tipo_paciente = TipoPaciente::all();
        return view('admin.pacientes.show',compact('paciente','tipo_afiliacion','tipo_paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);
        $usuario = User::where('id', $paciente->user_id)->first();
        $tipo_afiliacion = TipoAfiliacion::all();
        $tipo_paciente = TipoPaciente::all();
        return view('admin.pacientes.edit',compact('paciente','usuario','tipo_afiliacion','tipo_paciente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if($request->password != ""){
            $usuario = User::findOrFail($request->user_id);
            // Actualizar la contraseña encriptada
            $usuario->password = Hash::make($request->input('password'));
            $usuario->save();
        }
        
        $paciente = Paciente::find($id);

        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'ci' => 'required|unique:pacientes,ci,'.$paciente->id,
            'fecha_nacimiento' => 'required',
            'genero' => 'required',
            'celular' => 'required',
            'correo'=>'required|max:250|unique:pacientes,correo,'.$paciente->id,
            'direccion' => 'required',
            'grupo_sanguineo' => 'required',
            'alergias' => 'required',
            'contacto_emergencia' => 'required',
            'tipopaciente_id' => 'required',
            'tipoafiliacion_id' => 'required', 
        ]);

        $paciente->nombres = $request->nombres;
        $paciente->apellidos = $request->apellidos;
        $paciente->ci = $request->ci;
        $paciente->fecha_nacimiento = $request->fecha_nacimiento;
        $paciente->genero = $request->genero;
        $paciente->celular = $request->celular;
        $paciente->correo = $request->correo;
        $paciente->direccion = $request->direccion;
        $paciente->grupo_sanguineo = $request->grupo_sanguineo;
        $paciente->alergias = $request->alergias;
        $paciente->contacto_emergencia = $request->contacto_emergencia;
        $paciente->observaciones = $request->observaciones;
        $paciente->tipopaciente_id = $request->tipopaciente_id;
        $paciente->tipoafiliacion_id = $request->tipoafiliacion_id;
        $paciente->save();

        /*return redirect()->route('admin.pacientes.index')
            ->with('mensaje','Se actualizo al paciente de la manera correcta')
            ->with('icono','success');*/

            return back()
            ->with('mensaje','Se actualizo al paciente de la manera correcta')
            ->with('icono','success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirmDelete($id){
        $paciente = Paciente::findOrFail($id);
        $tipo_afiliacion = TipoAfiliacion::all();
        $tipo_paciente = TipoPaciente::all();
        $num_citas = Event::where('user_id',$paciente->user->id)->count();
        $num = $num_citas;
        return view('admin.pacientes.delete',compact('paciente','tipo_afiliacion','tipo_paciente','num'));
    }

    public function destroy($id)
    {
        $paciente = Paciente::findOrFail($id);
        User::destroy($paciente->user->id);
        Paciente::destroy($id);
        return redirect()->route('admin.pacientes.index')
            ->with('mensaje','Se elimino al paciente de la manera correcta')
            ->with('icono','success');
    }
}
