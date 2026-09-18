<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ex: le passe-partout coûte normalement 8€, mais pour telle photo
        // (format spécial, tirage plus grand...) il coûte 12€.
        // S'il n'y a pas d'entrée ici, on utilise le price_modifier par défaut
        // défini sur product_option_values.
        Schema::create('product_option_value_overrides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_option_value_id')->constrained()->cascadeOnDelete();
            $table->integer('price_modifier');
            $table->timestamps();

            $table->unique(['product_id', 'product_option_value_id'], 'product_value_override_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_option_value_overrides');
    }
};
