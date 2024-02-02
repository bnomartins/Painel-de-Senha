<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('senhas', function (Blueprint $table) {
            $table->id();

            $table->timestamp('dthrinicio')->nullable();
            $table->timestamp('dthrfim')->nullable();
                        
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('room')->nullable();         
            
            $table->foreignId('atendimento_id')->nullable()->constrained('atendimentos')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('chamar')->default(0);

            $table->timestamps();        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('senhas');
    }
};