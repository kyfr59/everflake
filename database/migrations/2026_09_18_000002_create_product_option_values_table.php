<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_option_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_option_group_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('value');   // clé machine, ex: "30x40", "oui", "rouge"
            $table->string('label');   // libellé affiché, ex: "30 x 40 cm"

            // Prix
            $table->enum('price_modifier_type', ['fixed', 'percent'])->default('fixed');
            $table->integer('price_modifier')->default(0); // en centimes si fixed

            // Logistique (ex: pour la taille du cadre -> coût d'expédition)
            $table->unsignedInteger('shipping_weight_grams')->nullable();
            $table->unsignedInteger('shipping_extra_cost')->nullable(); // en centimes

            $table->json('meta')->nullable(); // extensible (dimensions, etc.)
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();

            $table->unique(['product_option_group_id', 'value']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_option_values');
    }
};
