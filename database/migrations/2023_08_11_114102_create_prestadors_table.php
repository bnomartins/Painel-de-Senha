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
        Schema::create('prestadors', function (Blueprint $table) {
            $table->id();
            $table->string('cbo_codigo');            
            $table->string('cbo_descricao');            
            $table->string('conselho')->nullable();            
            $table->string('conselho_regional')->nullable();            
            $table->string('conselho_numero')->nullable();            
            $table->boolean('disponivel')->default(1);
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestadors');
    }
};
