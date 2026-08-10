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
        Schema::create('secteur_economiques', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // macro, bancaire, microfinance, assurance, paiement, petrole, agri, btp
            $table->string('titre');
            $table->string('sante'); // bon, moy, dif
            $table->json('kpis'); // [{l,v,d}, ...]
            $table->json('branches'); // [{n,pib,ev,note}, ...]
            $table->string('chart_label_1');
            $table->string('chart_label_2');
            $table->json('chart_categories'); // labels d'axe X (trimestres/années)
            $table->json('chart_dataset_1');
            $table->json('chart_dataset_2');
            $table->unsignedInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secteur_economiques');
    }
};
