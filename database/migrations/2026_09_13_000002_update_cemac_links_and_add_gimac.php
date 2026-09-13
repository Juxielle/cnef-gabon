<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('lien_utiles')
            ->where('groupe', 'CNEF des pays CEMAC')
            ->update(['groupe' => 'CNEF des autres pays de la CEMAC']);

        if (! DB::table('lien_utiles')->where('nom', 'GIMAC')->exists()) {
            DB::table('lien_utiles')->insert([
                'groupe' => 'Institutions financières internationales',
                'nom' => 'GIMAC',
                'description' => "Groupement Interbancaire Monétique de l'Afrique Centrale — interopérabilité des paiements dans la CEMAC",
                'url' => 'https://gimac-afr.com',
                'statut' => 'Actif',
                'ordre' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('lien_utiles')->where('nom', 'GIMAC')->delete();
        DB::table('lien_utiles')
            ->where('groupe', 'CNEF des autres pays de la CEMAC')
            ->update(['groupe' => 'CNEF des pays CEMAC']);
    }
};
