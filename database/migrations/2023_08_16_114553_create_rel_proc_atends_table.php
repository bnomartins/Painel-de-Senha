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
        Schema::create('rel_proc_atends', function (Blueprint $table) {
            $table->id();
            $table->foreignId('atendimento_id')->constrained('atendimentos')->onDelete('cascade')->onUpdate('cascade');
            $table->string('procedimento')->nullable();

            $table->text('descricao')->nullable();
            $table->text('observacao')->nullable();
            
            $table->string('local_origem')->nullable();
            $table->string('servico_origem')->nullable();
            
            $table->string('servico_destino')->nullable();

            $table->string('local_atendimento')->nullable();
            
            $table->foreignId('user_solicitacao_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_atendimento_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->boolean('finalizado')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rel_proc_atends');
    }
};
