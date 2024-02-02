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
        Schema::create('produtos', function (Blueprint $table) {
            $table->bigIncrements('id')->from(10000);

            $table->string('foto')->nullable();
            $table->text('codigo_barra')->nullable();
            
            $table->string('produto');

            $table->string('descricao_resumida')->nullable();
            $table->text('descricao_detalhada')->nullable();
            $table->string('composicao')->nullable();
            
            $table->string('especie')->nullable();
            $table->string('classe')->nullable();
            $table->string('subclasse')->nullable();

            $table->string('localizacao')->nullable();
           
            $table->string('unidade')->nullable();

            $table->boolean('patrimonio')->default(false);
            $table->string('patrimonio_numero')->nullable();

            $table->boolean('lote')->default(false);
            $table->string('lote_numero')->nullable();

            $table->date('fabricacao')->nullable();
            $table->date('validade')->nullable();
            $table->text('especificacao')->nullable();
            
            $table->text('anvisa')->nullable();
            $table->string('tarja')->nullable();

            $table->float('peso', 10,2)->nullable();
            $table->float('volume', 10,2)->nullable();

            $table->boolean('bloqueado')->default(false);
                        
            $table->foreignId('user_id')->constrained('users')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
