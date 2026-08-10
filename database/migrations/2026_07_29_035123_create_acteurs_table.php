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
        Schema::create('acteurs', function (Blueprint $table) {
            $table->id();
            $table->string('categorie'); // bancaire, paiement, marches, assurance, microfinance, economique
            $table->string('nom');
            $table->text('description');
            $table->string('badge');
            $table->text('icone_svg'); // contenu <path> du pictogramme SVG
            $table->unsignedInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acteurs');
    }
};
