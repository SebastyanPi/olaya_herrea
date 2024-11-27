<?php

namespace App\Http\Controllers;

use App\Models\TipoPaciente;
use App\Models\Paciente;
use Illuminate\Http\Request;

class TipoPacienteController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipopacientes = TipoPaciente::all();
        return view('admin.tipopaciente.index',compact('tipopacientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tipopaciente.create');
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

        TipoPaciente::create($request->all());

        return redirect()->route('admin.tipopaciente.index')
            ->with('mensaje','Se registro el tipo de paciente de la manera correcta')
            ->with('icono','success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tipopacientes = TipoPaciente::findOrFail($id);
        return view('admin.tipopaciente.show',compact('tipopacientes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tipopacientes = TipoPaciente::findOrFail($id);
        return view('admin.tipopaciente.edit',compact('tipopacientes'));
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

        $tipopacientes = TipoPaciente::find($id);
        $tipopacientes->update($request->all());

        return redirect()->route('admin.tipopaciente.index')
            ->with('mensaje','Se actualizó el tipo de paciente de la manera correcta')
            ->with('icono','success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirmDelete($id){
        $num = Paciente::where('tipopaciente_id',$id)->count();
        $tipopacientes = TipoPaciente::findOrFail($id);
        return view('admin.tipopaciente.delete',compact('tipopacientes','num'));
    }

    public function destroy($id)
    {
        $tipopacientes = TipoPaciente::find($id);
        $tipopacientes->delete();

        return redirect()->route('admin.tipopaciente.index')
            ->with('mensaje','Se elimino el tipo de paciente de la manera correcta')
            ->with('icono','success');
    }
}
