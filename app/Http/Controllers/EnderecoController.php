<?php

namespace App\Http\Controllers;

use App\Models\Enderecos;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(["response" => "Endereços"] , 200);
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
        $endereco = Enderecos::create($request->all());

        if( ! $endereco ){
            return response()->json(["response" => "Nãso foi possivel cadastrar esse endereço"] , 404);
        }

        return response()->json(["response" => "Endreço cadastrado com Sucesso"] , 404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $enderecos = Enderecos::find($id)->first();

        if (!$enderecos) {
            return response()->json(["response" => "Não foi possível encontrar esse endereço"], 404);
        }
    
        return response()->json(["response" =>$enderecos], 200);
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
        $enderecos = Enderecos::find($id);

        // Verifique se o usuário foi encontrado
        if (! $enderecos) {
            return response()->json(["response" => "Não foi possível encontrar esse endereço"], 404);
        }
    
        // Atualize o usuário com os dados da requisição
        $enderecos->update($request->all());
    
        return response()->json(["response" => "Endereço editado com sucesso"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $enderecos = Enderecos::find($id);

        // Verifique se o usuário foi encontrado
        if (! $enderecos) {
            return response()->json(["response" => "Não foi possível encontrar esse usuário"], 404);
        }
    
        // Atualize o usuário com os dados da requisição
        $enderecos->delete($id);
    
        return response()->json(["response" => "Pessoa removido com sucesso"], 200);
    }
}
