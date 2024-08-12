<?php

namespace App\Http\Controllers;

use App\Models\Pessoas;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::with('pessoas')->paginate(10);
        return view('dashboard.users' , compact('usuarios'));
        // return response()->json(["response" => "Hello Word"] , 200 );
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

        $create_usuario = [
            "email" => $request['email'],
            "password" =>  $request["password"],
            "level" => $request['level']
        ];
       
        $users = User::create($create_usuario);
      
        $create_pessoa = [
            "nome" => $request['nome'],
            "cpf" => $request['cpf'] ?? '',
            "cnpj" => $request['cnpj'] ?? '',
            "dt_nascimento" => $request['dt_nascimento'] ?? '',
            "user_id" => $users->id,
        ];

        $pessoa = Pessoas::create($create_pessoa);

        if( ! $users ){
            return redirect()->back()->with('danger', 'Erro cadastrar usuario');
        }

        return redirect()->back()->with('success', 'Usuário cadastrado com sucesso!');
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
    $user = User::find($id);

    $request["password"] = bcrypt($request['password']);

    // Verifique se o usuário foi encontrado
    if (! $user) {
        return response()->json(["response" => "Não foi possível encontrar esse usuário"], 404);
    }

    // Atualize o usuário com os dados da requisição
    $user->update($request->all());

    $update_pessoa = [
        "nome" => $request['nome'] ,
        "cpf" => $request['cpf'] ,
        "rg" => $request['rg'] ,
        "cnpj" => $request['cnpj'] ,
        "dt_nascimento" => $request['dt_nascimento'] ,
    ];
    $pessoa = Pessoas::where("user_id" , $user['id']);
    $pessoa->update($update_pessoa);

    return redirect()->back()->with('success', 'Usuário editado com sucesso!');
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
