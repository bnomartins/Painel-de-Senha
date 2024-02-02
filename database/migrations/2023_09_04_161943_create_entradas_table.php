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
        Schema::create('entradas', function (Blueprint $table) {
            $table->bigIncrements('id')->from(10000);

            $table->string('ordem_compra')->nullable();
            
            $table->string('documento_anexo')->nullable();
            $table->string('documento_tipo')->nullable();
            $table->integer('documento_numero')->nullable();
            $table->integer('documento_serie')->nullable();
            $table->date('documento_emissao')->nullable();

            $table->date('entrada')->nullable();

            $table->float('icms_base', 8,2)->nullable();
            $table->float('icms_valor', 8,2)->nullable();
            $table->float('icms_base_substituicao', 8,2)->nullable();
            $table->float('icms_valor_substituicao', 8,2)->nullable();

            $table->float('frete_valor', 8,2)->nullable();
            $table->float('seguro_valor', 8,2)->nullable();
            $table->float('ipi_valor', 8,2)->nullable();
            $table->float('outras_despesas_valor', 8,2)->nullable();

            $table->float('valor_total', 8, 2)->nullable();

            $table->string('lote')->nullable();
            $table->date('validade')->nullable();
            $table->float('quantidade', 8,2)->nullable();
            $table->float('valor_unitario', 8,2)->nullable();

            $table->foreignId('fornecedor_id')->constrained('users')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->nullable()->onDelete('cascade')->onUpdate('cascade');
            
            $table->text('observacao')->nullable();   

            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
