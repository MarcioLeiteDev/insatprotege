<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Veiculos extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        "id_pessoa",
        "modelo",
        "marca",
        "ano",
        "cor",
        "placa",
        "chassi",
        "renavam",
        "equipamento",
        "dt_instalacao",
        "central",
        "assist_24hs",
        "Observacoes",
        "equipamento_numero",
        "chip",
        "login",
        "senha",
        "vigencia",
        "valor",
        "status",
        "inicio",
        "vendedor",
        "contrato",
        "valor",
        'nomeVendedor',
        'vendedor',
    ];


    public function cobrancas(){
        return $this->hasMany(Cobrancas::class , 'id_veiculo' , 'id');
    }
}
