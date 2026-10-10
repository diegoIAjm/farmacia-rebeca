<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('auditoria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('sucursal_id')->nullable()->constrained('sucursales')->nullOnDelete();
            $table->string('accion', 100);
            $table->string('entidad', 50);
            $table->unsignedBigInteger('entidad_id')->nullable();
            $table->jsonb('datos_anteriores')->nullable();
            $table->jsonb('datos_nuevos')->nullable();
            $table->string('ip', 45)->nullable();
            $table->timestamps();

            $table->index(['user_id', 'created_at']);
            $table->index(['entidad', 'entidad_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('auditoria');
    }
};