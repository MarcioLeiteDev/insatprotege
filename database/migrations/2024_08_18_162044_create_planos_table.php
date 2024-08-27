<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Planos;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('planos', function (Blueprint $table) {
            $table->id();
            $table->string('plano');
            $table->float('valor' , 10 ,2);
            $table->integer('prazo');
            $table->timestamps();
            $table->softDeletes();
        });
        $dados = [
            ["plano" => "Plano 12" , "valor" => 79 , "prazo" => 12],
            ["plano" => "Plano 24" , "valor" => 69 , "prazo" => 24],
            ["plano" => "Plano 36" , "valor" => 59 , "prazo" => 36],
            ["plano" => "Zero" , "valor" => 0 , "prazo" => 0],
        ];

        Planos::insert($dados);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planos');
    }
};
