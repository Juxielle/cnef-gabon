<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agrement_dossiers', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('raison_sociale');
            $table->string('forme_juridique')->nullable();
            $table->string('numero_rccm')->nullable();
            $table->string('numero_nif')->nullable();
            $table->string('type_agrement');
            $table->string('nom_contact');
            $table->string('email');
            $table->string('telephone');
            $table->text('description')->nullable();
            $table->json('pieces_jointes')->nullable();
            $table->string('statut')->default('soumis');
            $table->text('commentaire_suivi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agrement_dossiers');
    }
};
