<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lotes_stock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->cascadeOnDelete();
            $table->foreignId('sucursal_id')->constrained('sucursales')->cascadeOnDelete();
            $table->string('lote', 50);
            $table->date('vencimiento');
            $table->decimal('costo', 10, 2);
            $table->integer('cantidad')->default(0);
            $table->decimal('descuento_porcentaje', 5, 2)->default(0);
            $table->timestamps();

            $table->index(['producto_id', 'sucursal_id', 'vencimiento']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lotes_stock');
    }
};