<?php

namespace App\Http\Controllers;

use App\Models\Pessoas;
use Illuminate\Http\Request;

class PessoasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(["response" => "Pessoas"] , 200);
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
        $dataExp = explode("/" ,$request['dt_nascimento']);

        $data = $dataExp[2] . "-" . $dataExp[1] . "-" . $dataExp[0];

        $request["dt_nascimento"] = $data;

        $pessoa = Pessoas::create($request->all());

        if( ! $pessoa ){
            return response()->json(["response" => "Não foi possivel cadastrar pessoas"] , 404);
        }

        return response()->json(["response" => "Pessoa cadastrada com Sucesso"] , 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pessoas = Pessoas::find($id)->with('enderecos')->first();

        if (!$pessoas) {
            return response()->json(["response" => "Não foi possível encontrar esse usuário"], 404);
        }
    
        return response()->json(["response" => $pessoas], 200);
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
        $pessoas = Pessoas::find($id);

    // Verifique se o usuário foi encontrado
    if (! $pessoas) {
        return response()->json(["response" => "Não foi possível encontrar esse usuário"], 404);
    }

    // Atualize o usuário com os dados da requisição
    $pessoas->update($request->all());

    return response()->json(["response" => "Pessoa editado com sucesso"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pessoas = Pessoas::find($id);

    // Verifique se o usuário foi encontrado
    if (! $pessoas) {
        return response()->json(["response" => "Não foi possível encontrar esse usuário"], 404);
    }

    // Atualize o usuário com os dados da requisição
    $pessoas->delete($id);

    return response()->json(["response" => "Pessoa removido com sucesso"], 200);
    }
}
