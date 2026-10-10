<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique();     // ej: 'anular_ventas'
            $table->string('etiqueta', 150);             // ej: 'Anular ventas'
            $table->string('modulo', 50);                // ej: 'ventas', 'inventario', 'usuarios'
            $table->text('descripcion')->nullable();
            $table->timestamps();

            $table->index('modulo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};