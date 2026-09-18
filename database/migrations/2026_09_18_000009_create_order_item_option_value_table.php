<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Snapshot des choix faits par le client sur une ligne de commande.
        // On duplique label/price_modifier au moment de la commande pour
        // ne jamais changer rétroactivement une commande déjà passée
        // si tu modifies les prix plus tard.
        Schema::create('order_item_option_value', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_option_value_id')->nullable()->constrained()->nullOnDelete();

            $table->string('group_label');   // snapshot: "Taille du cadre"
            $table->string('value_label');   // snapshot: "30 x 40 cm"
            $table->integer('price_modifier_snapshot')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_item_option_value');
    }
};
