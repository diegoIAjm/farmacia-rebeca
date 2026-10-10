<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 20)->unique();
            $table->foreignId('sucursal_id')->constrained('sucursales');
            $table->foreignId('user_id')->constrained('users');
            $table->string('cliente_nombre', 200)->default('Público en General');
            $table->string('cliente_documento', 20)->default('0');
            $table->enum('metodo_pago', ['efectivo', 'tarjeta', 'qr']);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('descuento_total', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->enum('estado', ['completada', 'anulada'])->default('completada');
            $table->text('motivo_anulacion')->nullable();
            $table->foreignId('anulada_por')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('anulada_at')->nullable();
            $table->timestamps();

            $table->index(['sucursal_id', 'created_at']);
            $table->index(['user_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};