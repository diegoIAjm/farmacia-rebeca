<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_barras', 50)->unique()->nullable();
            $table->string('nombre', 200);
            $table->string('principio_activo', 200)->nullable();
            $table->string('laboratorio', 100)->nullable();
            $table->string('forma_farmaceutica', 50)->nullable();
            $table->string('presentacion', 100)->nullable();
            $table->decimal('precio_venta', 10, 2);
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->index('nombre');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};