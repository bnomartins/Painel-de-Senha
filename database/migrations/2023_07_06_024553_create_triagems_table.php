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
        Schema::create('triagems', function (Blueprint $table) {
            $table->id();

            $table->string('queixa');

            $table->string('peso')->nullable();
            $table->string('altura')->nullable();

            $table->string('cintura')->nullable();
            $table->string('perimetro_cefalico')->nullable();

            $table->string('temperatura')->nullable();

            $table->string('pressao_arterial_diastolica')->nullable();
            $table->string('pressao_arterial_sistolica')->nullable();
            
            $table->string('frequencia_respiratoria')->nullable();
            $table->string('frequencia_cardiaca')->nullable();
            $table->string('glicemia_capilar')->nullable();
            $table->string('saturacao_o2')->nullable();

            $table->string('alergia')->nullable();

            $table->string('classificacao')->nullable();
            $table->text('observacao')->nullable();

            $table->timestamp('dthrsenha')->nullable();
            $table->timestamp('dthrinicio')->nullable();
            $table->timestamp('dthrfim')->nullable();

            $table->string('especialidade')->nullable(); // Clinica geral,
            $table->string('servico')->nullable(); // Clinica geral,
            $table->string('procedimento')->nullable(); // lista de procedimento sus descricao - código (atendimento de urgencia em atenção especializada - 0301060061),
            $table->string('cbo')->nullable(); // codigo - médico clínico (código brasileiro de ocupação)

            // $table->string('historico')->nullable(); //
            // $table->string('exame_fisico')->nullable(); //
            // $table->string('exame_psiquico')->nullable(); //
            // $table->string('hipotese_diagnostica')->nullable(); // f320 - depressão
            // $table->string('conduta')->nullable(); // abrir atendimento - encaminhado para rede

            $table->string('medico')->nullable(); // planista ou nominal


            $table->foreignId('atendimento_id')->constrained('atendimentos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('risco_id')->constrained('riscos')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('triagems');
    }
};
