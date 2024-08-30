<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('observacaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_veiculo')->constrained('veiculos');
            $table->string('equipamento')->nullable();

            $table->longText('Observacoes')->nullable();
            $table->string('equipamento_numero')->nullable();
            $table->string('chip')->nullable();
            $table->string('login')->nullable();
            $table->string('senha')->nullable();
            $table->string('contrato')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observacaos');
    }
};
