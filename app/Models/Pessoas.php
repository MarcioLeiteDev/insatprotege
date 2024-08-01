<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoas extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome',
        'rg',
        'cpf',
        'dt_nascimento',
        'user_id',
    ];


    public function enderecos(){
        return $this->hasMany(Enderecos::class , 'id_pessoa' , 'id');
    }

    public function telefones(){
        return $this->hasMany(Telefones::class , 'id_pessoa' , 'id');
    }

    public function veiculos(){
        return $this->hasMany(Veiculos::class , 'id_pessoa' , 'id')->with('veiculos');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
