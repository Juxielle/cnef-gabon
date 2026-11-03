<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\AgrementDossier;
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
            '/suivi-agrement',
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
        ];

        foreach ($pages as $page) {
            $response = $this->get($page);
            $response->assertStatus(200);
        }
    }

    public function test_mediation_subpages_redirect_to_presentation_page(): void
    {
        $redirectPages = [
            '/mediation-financiere/presentation',
            '/mediation-financiere/recours-a-la-mediation',
            '/mediation-financiere/etablissements-adherents',
            '/mediation-financiere/fonds-documentaire',
            '/mediation-financiere/contacts-utiles',
            '/mediation-financiere/suivi',
            '/mediation-financiere/candidature',
        ];

        foreach ($redirectPages as $page) {
            $this->get($page)->assertRedirect('/mediation-financiere');
        }
    }

    public function test_mediation_page_displays_presentation_and_redirect_button(): void
    {
        $response = $this->get('/mediation-financiere');
        $response->assertOk();
        $response->assertSee('La Médiation Financière');
        $response->assertSee('Décret N° 0121/PR/MEP');
        $response->assertSee('Accéder au Portail Dédié de la Médiation');
        $response->assertSee(config('app.mediation_portal_url', 'http://cnef-mediation.test'));
        $response->assertSee('Baromètre éco.');
        $response->assertSee('Médiation');
    }

    public function test_contact_form_stores_message(): void
    {
        $payload = [
            'nom' => 'Jean Ondo',
            'email' => 'jean.ondo@example.ga',
            'objet' => 'Demande d’information sur la réglementation',
            'message' => 'Bonjour, pouvez-vous m’indiquer la procédure d’agrément pour un établissement de paiement ?',
        ];

        $response = $this->post('/contact', $payload);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas(ContactMessage::class, [
            'email' => 'jean.ondo@example.ga',
            'objet' => 'Demande d’information sur la réglementation',
            'traite' => false,
        ]);
    }

    public function test_agrement_dossier_can_be_tracked_without_exposing_contact_data(): void
    {
        $dossier = AgrementDossier::create([
            'reference' => 'AGR-2026-TEST01',
            'raison_sociale' => 'Banque Gabonaise de Test',
            'forme_juridique' => 'Société Anonyme (SA)',
            'type_agrement' => 'etablissement_credit',
            'nom_contact' => 'Jean-Pierre Ondo',
            'email' => 'secret.demandeur@test.ga',
            'telephone' => '+241 77 00 00 00',
            'statut' => 'recevable',
            'commentaire_suivi' => 'Dossier déclaré complet, transmis au Secrétariat Général de la COBAC.',
        ]);


        $response = $this->post('/suivi-agrement/recherche', [
            'reference' => 'AGR-2026-TEST01',
        ]);

        $response->assertOk();
        $response->assertSee('AGR-2026-TEST01');
        $response->assertSee('Dossier déclaré complet');
        $response->assertDontSee('secret.demandeur@test.ga');
        $response->assertDontSee('+241 77 00 00 00');

    }

    public function test_chatbot_returns_contextual_guidance(): void
    {
        $response = $this->postJson('/assistant/message', [
            'message' => 'Comment obtenir un agrément bancaire ?',
        ]);

        $response->assertOk();
        $response->assertJsonStructure(['answer', 'action' => ['label', 'url']]);
        $response->assertJsonPath('action.label', 'Consulter les agréments');
        $response->assertJsonPath('action.url', route('agrements.index'));
    }

    public function test_chatbot_validates_empty_messages(): void
    {
        $response = $this->postJson('/assistant/message', [
            'message' => '',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['message']);
    }

    public function test_contact_form_validation_fails_on_missing_fields(): void
    {
        $response = $this->post('/contact', []);

        $response->assertSessionHasErrors(['nom', 'email', 'objet', 'message']);
    }
}
