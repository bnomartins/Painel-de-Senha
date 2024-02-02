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
        Schema::create('estoques', function (Blueprint $table) {
            $table->id();
                       
            $table->float('quantidade', 8,2)->nullable();
            $table->float('quantidade_limite')->nullable();
            
            $table->string('lote')->nullable();

            $table->float('valor_unitario', 8, 2)->nullable();
            
            $table->foreignId('identificacao_estoque_id')->constrained('identificacao_estoques')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('produto_id')->constrained('produtos')->nullable()->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estoques');
    }
};
