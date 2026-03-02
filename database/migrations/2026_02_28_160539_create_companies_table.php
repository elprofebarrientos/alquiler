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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('nit')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            $table->string('postal_code');
            $table->string('address');
            $table->string('url')->nullable();
            $table->string('type_company');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
