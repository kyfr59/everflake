<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained();

            $table->unsignedInteger('quantity')->default(1);
            $table->integer('unit_price'); // prix calculé au moment de la commande (centimes)

            // Champ libre pour la personnalisation du cartouche,
            // volontairement hors configurateur (pas de prix, pas d'incompatibilité)
            $table->string('cartouche_text')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
