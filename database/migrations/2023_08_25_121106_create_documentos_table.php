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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo')->nullable();
            $table->string('titulo')->nullable();
            $table->text('conteudo')->nullable();
            $table->foreignId('documento_modelo_id')->nullable()->constrained('documento_modelos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('clinico_id')->constrained('clinicos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('cancelado')->default(false);
            $table->boolean('finalizado')->default(false);
            $table->text('observacao')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
