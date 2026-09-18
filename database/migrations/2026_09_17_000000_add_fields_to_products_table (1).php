<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('nom')->after('id');
            $table->timestamp('horodatage');
            $table->unsignedInteger('longueur');
            $table->unsignedInteger('largeur');
            $table->string('orientation');
            $table->unsignedInteger('nombre_pixels');
            $table->string('photo')->unique();
            $table->string('reference')->unique();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->decimal('altitude', 7, 2)->nullable();
            $table->decimal('pression_atmospherique', 6, 2)->nullable();
            $table->decimal('luminosite_ambiante', 8, 2)->nullable();
            $table->decimal('temperature', 4, 1)->nullable();
            $table->decimal('humidite_relative', 5, 2)->nullable();
            $table->decimal('point_de_rosee', 4, 1)->nullable();
            $table->string('meteo')->nullable();
            $table->string('support')->nullable();
            $table->string('canton')->nullable()->index();
            $table->string('commune')->nullable()->index();
            $table->string('lieu_dit')->nullable();
            $table->boolean('eclairage')->nullable();
            $table->string('type_cristal')->nullable();
            $table->string('classe_morphologique')->nullable();
            $table->string('structure')->nullable();
            $table->unsignedTinyInteger('nombre_branches')->nullable();
            $table->string('symetrie')->nullable();
            $table->unsignedTinyInteger('nombre_axes')->nullable();
            $table->boolean('presence_dendrites')->default(false);
            $table->boolean('presence_plaquettes')->default(false);
            $table->boolean('presence_colonnes')->default(false);
            $table->boolean('presence_aiguilles')->default(false);
            $table->boolean('presence_givre')->default(false);
            $table->boolean('presence_gouttelettes')->default(false);
            $table->boolean('presence_fonte')->default(false);
            $table->text('fractures_deformations')->nullable();
            $table->text('ramification')->nullable();
            $table->decimal('taille_approximative', 5, 2)->nullable();
            $table->unsignedTinyInteger('degre_riming')->nullable();
        });
    }
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'nom', 'horodatage', 'longueur', 'largeur',
                'orientation', 'nombre_pixels', 'photo', 'reference',
                'latitude', 'longitude', 'altitude', 'pression_atmospherique',
                'luminosite_ambiante', 'temperature', 'humidite_relative',
                'point_de_rosee', 'meteo', 'support', 'canton', 'commune',
                'lieu_dit', 'eclairage',
                'type_cristal', 'classe_morphologique', 'structure',
                'nombre_branches', 'symetrie', 'nombre_axes',
                'presence_dendrites', 'presence_plaquettes', 'presence_colonnes',
                'presence_aiguilles', 'presence_givre', 'presence_gouttelettes',
                'presence_fonte', 'fractures_deformations', 'ramification',
                'taille_approximative', 'degre_riming',
            ]);
        });
    }
};
