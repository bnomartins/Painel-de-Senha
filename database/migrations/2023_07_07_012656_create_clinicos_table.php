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
        Schema::create('clinicos', function (Blueprint $table) {
            $table->id();

            $table->timestamp('dthrsenha')->nullable();
            $table->timestamp('dthrinicio')->nullable();
            $table->timestamp('dthrfim')->nullable();

            //Anmenese
            $table->string('anamnese_queixa')->nullable();
            $table->string('anamnese_historico_molestia')->nullable();
            $table->string('anamnese_historico_patologia')->nullable();
            $table->string('anamnese_historico_familiar')->nullable();
            $table->string('anamnese_antecedentes_morbidos')->nullable();
            $table->string('anamnese_exame_fisico')->nullable();
            $table->string('anamnese_observacao')->nullable();

            //Diagnostico/Hipotese
            $table->string('diagnostico_hipotese1')->nullable();
            $table->text('diagnostico_hipotese1_observacao')->nullable();

            $table->string('diagnostico_hipotese2')->nullable();
            $table->text('diagnostico_hipotese2_observacao')->nullable();

            $table->string('diagnostico_confirmado1')->nullable();
            $table->text('diagnostico_confirmado1_observacao')->nullable();

            $table->string('hipotese_diagnostica1')->nullable();
            $table->text('hipotese_diagnostica2')->nullable();

            $table->string('diagnostico_confirmado2')->nullable();
            $table->text('diagnostico_confirmado2_observacao')->nullable();

            
            $table->string('conduta')->nullable();
            $table->string('prognostico')->nullable();
            
            $table->string('evolucao')->nullable();
                        
            $table->string('alta_motivo')->nullable();
            $table->string('alta_observacao')->nullable();
            $table->string('alta_data')->nullable();

            $table->foreignId('atendimento_id')->constrained('atendimentos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinicos');
    }
};
