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
        Schema::create('rel_est_users', function (Blueprint $table) {
            $table->id();
            $table->string('acesso')->nullable();
            $table->foreignId('usuario_id')->constrained('users')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('identificacao_estoque_id')->constrained('identificacao_estoques')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rel_est_users');
    }
};
