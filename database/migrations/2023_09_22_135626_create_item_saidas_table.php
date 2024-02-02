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
        Schema::create('item_saidas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('saida_id')->constrained('saidas')->nullable()->onDelete('cascade')->onUpdate('cascade');

            $table->float('quantidade', 8,2)->nullable();
            $table->string('lote')->nullable();

            $table->foreignId('estoque_id')->constrained('estoques')->nullable()->onDelete('cascade')->onUpdate('cascade');

            $table->foreignId('cancelado_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('item_saidas');
    }
};
