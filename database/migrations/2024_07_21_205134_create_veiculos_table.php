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
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pessoa')->nullable();
            $table->string('modelo')->nullable();
            $table->string('marca')->nullable();
            $table->string('ano')->nullable();
            $table->string('cor')->nullable();
            $table->string('placa')->nullable();
            $table->string('chassi')->nullable();
            $table->string('renavam')->nullable();
            $table->string('equipamento')->nullable();
            $table->date('dt_instalacao')->nullable();
            $table->boolean('central')->default(0);
            $table->boolean('assist_24hs')->default(0);
            $table->longText('Observacoes')->nullable();
            $table->string('equipamento_numero')->nullable();
            $table->string('chip')->nullable();
            $table->string('login')->nullable();
            $table->string('senha')->nullable();
            $table->integer('vigencia')->nullable();
            $table->float('valor')->nullable();
            $table->boolean('status')->default(1)->comment('1 ativo 0 inativo');
            $table->date('inicio')->nullable();
            $table->unsignedBigInteger('vendedor')->nullable();
            $table->string('contrato')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Add foreign key constraints if necessary
            $table->foreign('id_pessoa')->references('id')->on('pessoas');
            $table->foreign('vendedor')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veiculos');
    }
};
