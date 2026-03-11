<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('permite_venta')->default(true)->after('estado');
            $table->boolean('permite_alquiler')->default(false)->after('permite_venta');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['permite_venta', 'permite_alquiler']);
        });
    }
};
