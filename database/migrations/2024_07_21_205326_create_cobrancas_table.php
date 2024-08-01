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
        Schema::create('cobrancas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_veiculo')->constrained('veiculos');
            $table->float('valor')->nullable();
            $table->integer('numero')->nullable();
            $table->date('dt_vencimento')->nullable();
            $table->integer('status')->nullable()->comment('1 aguardando 2- pago 3 - atrasado');
            $table->longText('codigo_barras')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cobrancas');
    }
};
