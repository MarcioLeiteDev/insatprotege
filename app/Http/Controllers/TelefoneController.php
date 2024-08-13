<?php

namespace App\Http\Controllers;

use App\Models\Pessoas;
use App\Models\Telefones;
use Illuminate\Http\Request;

class TelefoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $pessoa = Pessoas::findOrFail($id);
        $telefones = Telefones::where('id_pessoa' , $id)->get();
        return view('dashboard.telefones' , compact('id' , 'pessoa' , 'telefones'));
    //    return response()->json(["response" => "Telefones"] , 200);
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
    public function store(Request $request , $id )
    {
        $telefone = Telefones::create($request->all());

        if(! $telefone){
            return response()->json(["response" => "Não foi possivel cadastrar telefones"], 404);
        }
        return redirect()->route('escritorio.telefones.index' , [$id] )->with('success', 'Telefone cadastrado com sucesso!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $telefones = Telefones::where("id" ,$id)->first();

        if (!$telefones) {
            return response()->json(["response" => "Não foi possível encontrar esse usuário"], 404);
        }
    
        return response()->json(["response" => $telefones], 200);
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
        $telefones = Telefones::where("id" ,$id)->first();

        $telefones->update($request->all());

        if (!$telefones) {
            return response()->json(["response" => "Não foi possível encontrar esse telefone"], 404);
        }
    
        return response()->json(["response" => "Telefone editado com sucesso."], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $telefones = Telefones::where("id" ,$id)->first();

        $telefones->delete($id);

        if (!$telefones) {
            return response()->json(["response" => "Não foi possível encontrar esse telefone"], 404);
        }
    
        return response()->json(["response" => "Telefone editado com sucesso."], 200);
    }
}
