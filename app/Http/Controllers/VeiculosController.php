<?php

namespace App\Http\Controllers;

use App\Models\Planos;
use App\Models\Veiculos;
use Illuminate\Http\Request;

class VeiculosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $planos = Planos::all();
        return view('dashboard.veiculos' , compact('planos'));
        // return response()->json(["response" => "veiculos"], 200);
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
        $dt_inst_exp = explode("/" , $request['dt_instalacao']);
        $dt_inst = $dt_inst_exp[2] . "-" . $dt_inst_exp[1] . "-" . $dt_inst_exp[0];

        $request["dt_instalacao"] = $dt_inst;
        $veiculos = Veiculos::create($request->all());

        if( ! $veiculos ){
            return response()->json(["response" => "Não foi possivel cadastrar esse veiculo"] , 404);
        }

        return response()->json(["response" => "veiculo cadastrado com Sucesso"] , 201);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
