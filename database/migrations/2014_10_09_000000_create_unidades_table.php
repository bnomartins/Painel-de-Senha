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
        Schema::create('unidades', function (Blueprint $table) {

            $table->id();

            $table->string('logotipo')->nullable();

            $table->string('nome_fantasia');
            $table->string('cnpj')->nullable();
            $table->string('cnes')->nullable();

            $table->string('tipo')->nullable(); // Centro de atenção hemoterápica e ou hematologica
            $table->string('natureza_juridica')->nullable(); // administração publica

            $table->string('responsavel')->nullable();

            $table->string('telefone1')->nullable();
            $table->string('telefone2')->nullable();
            $table->string('telefone3')->nullable();
            $table->string('email')->nullable();

            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('cep')->nullable();

            $table->string('chave_codigo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades');
    }
};
