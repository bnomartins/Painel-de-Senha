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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            // $table->bigIncrements('id')->from(10001);

            $table->string('foto')->nullable();
            $table->string('nome');
            $table->string('nome_social')->nullable();

            $table->string('cartao_sus')->nullable()->unique();
            $table->string('registro')->nullable()->unique();
            $table->string('cpf')->nullable()->unique();
            $table->string('rg_numero')->nullable();
            $table->string('rg_orgao')->nullable();
            $table->date('rg_data')->nullable();

            $table->string('aborh')->nullable();

            $table->string('estado_civil')->nullable();
            $table->string('sexo')->nullable();
            $table->string('raca')->nullable();
            $table->date('nascimento')->nullable();

            $table->string('convenio')->nullable();
            $table->string('plano')->nullable();

            $table->string('mae')->nullable();
            $table->string('pai')->nullable();

            $table->string('conjuge')->nullable();

            $table->string('nacionalidade')->nullable();
            $table->string('naturalidade')->nullable();

            $table->string('profissao')->nullable();
            $table->string('grau_instrucao')->nullable();

            $table->string('endereco')->nullable();
            $table->string('endereco_numero')->nullable();
            $table->string('endereco_complemento')->nullable();
            $table->string('endereco_cep')->nullable();
            $table->string('endereco_bairro')->nullable();
            $table->string('endereco_cidade')->nullable();
            $table->string('endereco_estado')->nullable();

            $table->string('contato_email')->nullable();

            $table->string('contato_telefone1')->nullable();
            $table->string('contato_telefone2')->nullable();
            $table->string('contato_telefone3')->nullable();

            $table->foreignId('prontuario_id')->nullable()->constrained('prontuarios')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
