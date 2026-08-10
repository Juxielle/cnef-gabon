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
        Schema::create('lien_utiles', function (Blueprint $table) {
            $table->id();
            $table->string('groupe'); // "CNEF des pays CEMAC", "Régulateurs régionaux CEMAC", ...
            $table->string('nom');
            $table->string('pays')->nullable();
            $table->string('capitale')->nullable();
            $table->text('description');
            $table->string('url');
            $table->string('statut')->default('Actif'); // Actif, En déploiement
            $table->text('drapeau_svg')->nullable();
            $table->unsignedInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lien_utiles');
    }
};
