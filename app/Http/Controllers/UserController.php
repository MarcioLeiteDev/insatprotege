<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(["response" => "Hello Word"] , 200 );
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
        $request["password"] = bcrypt($request['password']);

        $users = User::create($request->all());

        if( ! $users ){
            return response()->json(["response" => "Erro ao cadastrar usuario"] , 404 );
        }

        return response()->json(["response" => "Usuario Cadastrado com Sucesso"] , 201 );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('pessoas')->findOrFail($id);

        if (!$user) {
            return response()->json(["response" => "Não foi possível encontrar esse usuário"], 404);
        }
    
        return response()->json(["response" => $user], 200);
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

         // Tente encontrar o usuário pelo ID
    $user = User::find($id);

    // Verifique se o usuário foi encontrado
    if (! $user) {
        return response()->json(["response" => "Não foi possível encontrar esse usuário"], 404);
    }

    // Atualize o usuário com os dados da requisição
    $user->update($request->all());

    return response()->json(["response" => "Usuário editado com sucesso"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        // Verifique se o usuário foi encontrado
        if (! $user) {
            return response()->json(["response" => "Não foi possível encontrar esse usuário"], 404);
        }
    
        // Atualize o usuário com os dados da requisição
        $user->delete($id);
    
        return response()->json(["response" => "Usuário deletado com sucesso"], 200);
    }


}
