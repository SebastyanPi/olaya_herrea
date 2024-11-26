<?php

namespace App\Http\Controllers;

use App\Models\Configuracione;
use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfiguracioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $configuraciones = Configuracione::all();
        $horario = Horario::first();
        
        return view('admin.configuraciones.index',compact('configuraciones','horario'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.configuraciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);

        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
            'logo'=>'required',
        ]);

        $configuracion = new Configuracione();

        $configuracion->nombre = $request->nombre;
        $configuracion->direccion = $request->direccion;
        $configuracion->telefono = $request->telefono;
        $configuracion->correo = $request->correo;
        $configuracion->logo = $request->file('logo')->store('logos','public');

        $configuracion->save();

        return redirect()->route('admin.configuraciones.index')
            ->with('mensaje','Se registro la configuración de la manera correcta')
            ->with('icono','success');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $configuracion = Configuracione::find($id);
        return view('admin.configuraciones.show',compact('configuracion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $configuracion = Configuracione::find($id);
        return view('admin.configuraciones.edit',compact('configuracion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       //$datos = request()->all();
       //return response()->json($datos);
        //dd($request->all(), $request->file('logo'));
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
        ]);

        $configuracion = Configuracione::find($id);

        $configuracion->nombre = $request->nombre;
        $configuracion->direccion = $request->direccion;
        $configuracion->telefono = $request->telefono;
        $configuracion->correo = $request->correo;

        if($request->hasFile('logo')){
            Storage::delete('public/'.$configuracion->logo);
            $configuracion->logo = $request->file('logo')->store('logos','public');
        }

        $configuracion->save();

        return redirect()->route('admin.configuraciones.index')
            ->with('mensaje','Se actualizo la configuración de la manera correcta')
            ->with('icono','success');



    }

    /**
     * Remove the specified resource from storage.
     */

    public function confirmDelete($id){
        $configuracion = Configuracione::find($id);
        return view('admin.configuraciones.delete',compact('configuracion'));
    }

    public function destroy($id)
    {
        $configuracion = Configuracione::find($id);
        Storage::delete('public/'.$configuracion->logo);
        Configuracione::destroy($id);

        return redirect()->route('admin.configuraciones.index')
            ->with('mensaje','Se elimino la configuración de la manera correcta')
            ->with('icono','success');

    }
}
