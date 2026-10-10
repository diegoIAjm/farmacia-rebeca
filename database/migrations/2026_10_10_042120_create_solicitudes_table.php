<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 20)->unique();
            $table->foreignId('sucursal_origen_id')->constrained('sucursales');
            $table->foreignId('sucursal_destino_id')->constrained('sucursales');
            $table->foreignId('producto_id')->constrained('productos');
            $table->foreignId('lote_id')->nullable()->constrained('lotes_stock')->nullOnDelete();
            $table->integer('cantidad_solicitada');
            $table->integer('cantidad_aprobada')->nullable();
            $table->enum('estado', ['pendiente', 'aprobada', 'rechazada', 'transferida'])->default('pendiente');
            $table->foreignId('user_solicita_id')->constrained('users');
            $table->foreignId('user_aprueba_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('motivo_rechazo')->nullable();
            $table->timestamps();

            $table->index(['sucursal_destino_id', 'estado']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};