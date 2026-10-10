<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transferencias', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 20)->unique();
            $table->foreignId('solicitud_id')->nullable()->constrained('solicitudes')->nullOnDelete();
            $table->foreignId('sucursal_origen_id')->constrained('sucursales');
            $table->foreignId('sucursal_destino_id')->constrained('sucursales');
            $table->foreignId('producto_id')->constrained('productos');
            $table->foreignId('lote_id')->constrained('lotes_stock');
            $table->integer('cantidad');
            $table->enum('estado', ['pendiente', 'completada', 'cancelada'])->default('completada');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();

            $table->index(['sucursal_origen_id', 'created_at']);
            $table->index(['sucursal_destino_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transferencias');
    }
};