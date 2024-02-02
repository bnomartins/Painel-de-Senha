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
        Schema::create('identificacao_estoques', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('identificacao')->nullable();
            $table->string('descricao')->nullable();
            $table->boolean('disponivel')->default(true);
            $table->foreignId('user_id')->constrained('users')->nullable()->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identificacao_estoques');
    }
};
