<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cortes_caja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sucursal_id')->constrained('sucursales');
            $table->foreignId('user_id')->constrained('users');
            $table->decimal('caja_inicial', 10, 2)->default(0);
            $table->decimal('ventas_efectivo', 10, 2)->default(0);
            $table->decimal('ventas_tarjeta', 10, 2)->default(0);
            $table->decimal('ventas_qr', 10, 2)->default(0);
            $table->decimal('total_ventas', 10, 2)->default(0);
            $table->decimal('efectivo_esperado', 10, 2)->default(0);
            $table->decimal('efectivo_contado', 10, 2);
            $table->decimal('sobrante_faltante', 10, 2)->default(0);
            $table->text('observaciones')->nullable();
            $table->timestamps();

            $table->index(['sucursal_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cortes_caja');
    }
};