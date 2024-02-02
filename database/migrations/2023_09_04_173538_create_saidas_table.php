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
        Schema::create('saidas', function (Blueprint $table) {
            $table->id();

            $table->string('status')->nullable();
            $table->boolean('estoque')->default(false);
            $table->boolean('setor')->default(false);
            $table->boolean('paciente')->default(false);

            $table->foreignId('setor_id')->constrained('setors')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('paciente_id')->nullable()->constrained('pacientes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('identificacao_estoque_origem_id')->nullable()->constrained('identificacao_estoques')->onDelete('cascade')->onUpdate('cascade');            
            $table->foreignId('identificacao_estoque_destino_id')->nullable()->constrained('identificacao_estoques')->onDelete('cascade')->onUpdate('cascade');            

            $table->foreignId('solicitacao_id')->constrained('users')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->date('solicitacao_dthr')->nullable();
            
            $table->foreignId('liberacao_id')->nullable()->constrained('users');
            $table->date('liberacao_dthr')->nullable();

            $table->foreignId('cancelado_id')->nullable()->constrained('users');
            $table->boolean('cancelado')->default(false);   

            $table->text('observacao')->nullable();   


            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saidas');
    }
};
