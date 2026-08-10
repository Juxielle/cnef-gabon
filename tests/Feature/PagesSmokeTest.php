<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\MediationRequest;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagesSmokeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_all_public_pages_load_successfully(): void
    {
        $pages = [
            '/',
            '/acteurs',
            '/acteurs?categorie=bancaire',
            '/agrements',
            '/veille-reglementaire',
            '/veille-reglementaire?categorie=cobac',
            '/barometre-economique',
            '/barometre-economique?secteur=bancaire',
            '/etudes',
            '/education-financiere',
            '/actualites',
            '/actualites?tab=veille',
            '/actualites?tab=veille&veille_categorie=ia',
            '/liens-utiles',
            '/mediation-financiere',
            '/mediation-financiere?tab=procedure',
            '/mediation-financiere?tab=stats',
            '/mediation-financiere?tab=candidature',
        ];

        foreach ($pages as $page) {
            $response = $this->get($page);
            $response->assertStatus(200);
        }
    }

    public function test_contact_form_stores_message(): void
    {
        $response = $this->post('/contact', [
            'nom' => 'Jean Test',
            'email' => 'jean@test.ga',
            'objet' => 'Question réglementaire',
            'message' => 'Ceci est un message de test.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas(ContactMessage::class, ['email' => 'jean@test.ga']);
    }

    public function test_contact_form_validation_fails_on_missing_fields(): void
    {
        $response = $this->post('/contact', []);
        $response->assertSessionHasErrors(['nom', 'email', 'objet', 'message']);
    }

    public function test_mediation_saisine_stores_request(): void
    {
        $response = $this->post('/mediation-financiere/saisine', [
            'prenom' => 'Marie',
            'nom' => 'Obiang',
            'email' => 'marie@test.ga',
            'etablissement' => 'BGFI Bank Gabon',
            'nature_litige' => 'Contestation de frais ou commission',
            'description' => 'Description du litige de test.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas(MediationRequest::class, ['email' => 'marie@test.ga']);
    }

    public function test_mediateur_candidature_stores_application(): void
    {
        $response = $this->post('/mediation-financiere/candidature', [
            'prenom' => 'Paul',
            'nom' => 'Ngoua',
            'email' => 'paul@test.ga',
            'branche' => 'Branche 1 — Crédit, Microfinance & Paiement',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas(\App\Models\MediateurCandidature::class, ['email' => 'paul@test.ga']);
    }
}
