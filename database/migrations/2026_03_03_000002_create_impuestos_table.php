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
        Schema::create('impuestos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->decimal('porcentaje', 5, 2);
            $table->string('codigo_dian')->nullable();
            $table->boolean('es_retencion')->default(false);
            $table->boolean('es_trasladable')->default(true);
            $table->boolean('es_compuesto')->default(false);
            $table->integer('orden_calculo')->default(1);
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impuestos');
    }
};
