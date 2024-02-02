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
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();
            $table->string('lote')->nullable();
            $table->date('validade')->nullable();
            $table->text('localizacao')->nullable();
            $table->float('quantidade', 8,2)->nullable();
            $table->float('valor_unitario', 8,2)->nullable();

            $table->foreignId('estoque_id')->constrained('estoques')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('fornecedor_id')->constrained('fornecedors')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotes');
    }
};
