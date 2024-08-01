<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cobrancas extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'veiculo_id',
        'valor',
        'numero',
        'dt_vencimento',
        'status',
        'codigo_barras',
    ];


}
