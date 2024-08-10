<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida as credenciais fornecidas e as atribui à variável $credentials
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        // Tenta autenticar o usuário com as credenciais
        if (Auth::attempt($credentials)) {
            // Regenera a sessão para evitar fixação de sessão
            $request->session()->regenerate();
    
            // Redireciona o usuário para a área administrativa
            return redirect('escritorio');
        }
    
        // Se as credenciais forem inválidas, redireciona de volta para o formulário de login com um erro
        return back()->withErrors([
            'session' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ]);
    }
    




}
