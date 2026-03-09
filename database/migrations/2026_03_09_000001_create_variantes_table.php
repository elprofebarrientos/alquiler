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
        Schema::create('variantes', function (Blueprint $table) {
            $table->id();
            $table->decimal('precio_compra', 12, 2)->nullable();
            $table->decimal('porcentaje_ganancia', 5, 2)->nullable();
            $table->decimal('precio_venta', 12, 2)->default(0);
            $table->json('imagenes')->nullable();
            $table->string('sku', 50)->nullable();
            $table->string('codigos_barras', 50)->nullable();
            $table->boolean('estado')->default(true);
            $table->foreignId('id_producto')->constrained('products')->onDelete('cascade');
            $table->foreignId('id_talla')->nullable()->constrained('tallas');
            $table->foreignId('id_color')->nullable()->constrained('colores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variantes');
    }
};
