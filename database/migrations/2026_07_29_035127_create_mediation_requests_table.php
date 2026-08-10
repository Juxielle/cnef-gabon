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
        Schema::create('mediation_requests', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('prenom');
            $table->string('nom');
            $table->string('email');
            $table->string('telephone')->nullable();
            $table->string('etablissement');
            $table->string('nature_litige');
            $table->text('description');
            $table->json('pieces_jointes')->nullable(); // chemins storage
            $table->string('statut')->default('nouveau'); // nouveau, en_cours, resolu, rejete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mediation_requests');
    }
};
