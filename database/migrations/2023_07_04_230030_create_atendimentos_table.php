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
        Schema::create('atendimentos', function (Blueprint $table) {
            $table->id();

            $table->string('senha')->nullable();
            $table->string('status')->nullable();
            //internados ambulatorios todos pacientes pacientes agendados
            $table->string('convenio')->nullable(); // SUS - Ambulatorio e outros
            $table->string('tipo')->nullable(); // Avaliação, extra, primeira consulta - Eletiva, primeira consulta - URGÊNCIA, retorno, 

            $table->string('origem')->nullable(); // pronto socorro adulto, infantil urgencia cardiologica
            $table->string('destino')->nullable(); // Sala de Triagem
            
            
            $table->timestamp('dthrsenha')->nullable();
            $table->timestamp('dthrinicio')->nullable();
            $table->timestamp('dthrfim')->nullable();
            
            $table->boolean('chamar')->default(0);
            $table->boolean('finalizado')->default(0); // 

            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atendimentos');
    }
};
