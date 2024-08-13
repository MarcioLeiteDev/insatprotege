<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enderecos extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_pessoa',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
        'cep',
        'tipo',
    ];

    public function pessoas(){
        return $this->belongsTo(Pessoas::class , 'id_pessoa' , 'id');
    }
}
