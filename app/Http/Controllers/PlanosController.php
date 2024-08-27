<?php

namespace App\Http\Controllers;

use App\Models\Planos;
use Illuminate\Http\Request;

class PlanosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planos = Planos::paginate(10);

        return view('dashboard.planos' , compact('planos'));
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
        $plano = Planos::create($request->all());

        if(!$plano){
            return response()->json(['status' => false , 'response' => 'Não foi possivel cadastrar esse plano'], 404);
        }
        return redirect()->route('escritorio.planos.index'  )->with('success', 'Plano cadastrado com sucesso!');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $plano = Planos::find($id);

        $plano->update($request->all());

        if(!$plano->update($request->all())){
            return response()->json(['status' => false , 'response' => 'Não foi possivel editar esse plano'], 404);
        }

        return response()->json(['status' => true , 'response' => 'Plano editado com sucesso.'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plano = Planos::find($id);

        $plano->delete($id);

        if(!$plano->delete($id)){
            return response()->json(['status' => false , 'response' => 'Não foi possivel editar esse plano'], 404);
        }

        return response()->json(['status' => true , 'response' => 'Plano editado com sucesso.'], 404);
    }
}
