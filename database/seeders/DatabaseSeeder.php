<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrateur CNEF',
            'email' => 'admin@cnef.ga',
            'password' => Hash::make('CnefGabon2025!'),
        ]);

        $this->call([
            ActeurSeeder::class,
            TexteReglementaireSeeder::class,
            EtudeSeeder::class,
            ActualiteSeeder::class,
            VeilleInnovationSeeder::class,
            LienUtileSeeder::class,
            SecteurEconomiqueSeeder::class,
            BaroKpiSeeder::class,
            MediationKpiSeeder::class,
            MediationLitigeSeeder::class,
            MediationSaisineTrimestreSeeder::class,
        ]);
    }
}
