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
        Schema::create('exames', function (Blueprint $table) {
            $table->id();

            $table->string('resultado')->nullable();
            $table->text('observacao')->nullable();

            $table->timestamp('dthrinicio')->nullable();
            $table->timestamp('dthrfim')->nullable();

            $table->foreignId('clinico_id')->constrained('clinicos')->onDelete('cascade')->onUpdate('cascade');

            $table->foreignId('procedimento_id')->constrained('procedimentos')->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreignId('solicitacao_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exames');
    }
};
