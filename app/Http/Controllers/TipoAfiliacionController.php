<?php

namespace App\Http\Controllers;

use App\Models\TipoAfiliacion;
use Illuminate\Http\Request;
use App\Models\Paciente;

class TipoAfiliacionController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoafiliacion = TipoAfiliacion::all();
        return view('admin.tipoafiliacion.index',compact('tipoafiliacion'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tipoafiliacion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // $datos = request()->all();
        //return response()->json($datos);
        $request->validate([
            'nombre' => 'required',
            'detalle' => 'required',
        ]);

        TipoAfiliacion::create($request->all());

        return redirect()->route('admin.tipoafiliacion.index')
            ->with('mensaje','Se registro el tipo de afiliacion de la manera correcta')
            ->with('icono','success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tipoafiliacion = TipoAfiliacion::findOrFail($id);
        return view('admin.tipoafiliacion.show',compact('tipoafiliacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $tipoafiliacion = TipoAfiliacion::findOrFail($id);
        return view('admin.tipoafiliacion.edit',compact('tipoafiliacion'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'detalle' => 'required'
        ]);

        $tipoafiliacion = TipoAfiliacion::find($id);
        $tipoafiliacion->update($request->all());

        return redirect()->route('admin.tipoafiliacion.index')
            ->with('mensaje','Se actualizó el tipo de afiliación de la manera correcta')
            ->with('icono','success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirmDelete($id){
    
        $num = Paciente::where('tipoafiliacion_id',$id)->count();
        $tipoafiliacion = TipoAfiliacion::findOrFail($id);
        return view('admin.tipoafiliacion.delete',compact('tipoafiliacion','num'));
    }

    public function destroy($id)
    {
        $tipoafiliacion = TipoAfiliacion::find($id);
        $tipoafiliacion->delete();

        return redirect()->route('admin.tipoafiliacion.index')
            ->with('mensaje','Se elimino el tipo de afiliación de la manera correcta')
            ->with('icono','success');
    }
}

