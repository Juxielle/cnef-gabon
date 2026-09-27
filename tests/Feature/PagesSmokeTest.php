<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\AgrementDossier;
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
            // 6 Rubriques Officielles de la Médiation Financière
            '/mediation-financiere', // B.1 Accueil
            '/mediation-financiere/presentation', // B.2 Présentation
            '/mediation-financiere/recours-a-la-mediation', // B.3 Recours à la médiation
            '/mediation-financiere/etablissements-adherents', // B.4 Établissements adhérents
            '/mediation-financiere/fonds-documentaire', // B.5 Fonds documentaire
            '/mediation-financiere/contacts-utiles', // B.6 Contacts utiles
            // Routes de compatibilité et actions
            '/mediation-financiere?tab=candidature',
            '/mediation-financiere?tab=stats',
            '/mediation-financiere/textes-reglementaires',
            '/mediation-financiere/actualites',
            '/mediation-financiere/activites',
            '/mediation-financiere/candidature',
            '/mediation-financiere/suivi',
        ];

        foreach ($pages as $page) {
            $response = $this->get($page);
            $response->assertStatus(200);
        }
    }

    public function test_mediation_section_displays_dedicated_menu_and_allows_returning_to_main_portal(): void
    {
        // Sur une page de médiation, le menu spécifique décline les 6 rubriques officielles
        $response = $this->get('/mediation-financiere/presentation');
        $response->assertOk();
        $response->assertSee('aria-label="Navigation Médiation Financière"', false);
        $response->assertSee('Portail CNEF');
        $response->assertSee('Accueil');
        $response->assertSee('Présentation');
        $response->assertSee('Recours à la médiation');
        $response->assertSee('Informations utiles');
        $response->assertSee('Établissements adhérents');
        $response->assertSee('Fonds documentaire');
        $response->assertSee('Contacts utiles');
        $response->assertSee('Saisir le Médiateur');
        $response->assertDontSee('Baromètre éco.');

        // Sur la page d'accueil principale, le menu général du CNEF est affiché
        $homeResponse = $this->get('/');
        $homeResponse->assertOk();
        $homeResponse->assertSee('aria-label="Navigation principale CNEF"', false);
        $homeResponse->assertSee('Baromètre éco.');
        $homeResponse->assertSee('Médiation');
    }

    public function test_mediation_form_displays_official_establishment_groups(): void
    {
        $response = $this->get('/mediation-financiere/recours-a-la-mediation');
        $response->assertOk();
        $response->assertSee('Établissements de crédits');
        $response->assertSee('AFG Bank');
        $response->assertSee('Société de Garantie du Gabon (SGG)');
        $response->assertSee('Établissements de Micro Finance (EMF)');
        $response->assertSee('CECAG EMF');
        $response->assertSee('Établissements de paiement');
        $response->assertSee('AIRTEL MONEY');
        $response->assertSee('Assurances');
        $response->assertSee('BGFI ASSURANCE');
        $response->assertSee('Intermédiaires marchés');
        $response->assertSee('BGFIBourse');
    }

    public function test_adherents_page_displays_official_3_branches(): void
    {
        $response = $this->get('/mediation-financiere/etablissements-adherents');
        $response->assertOk();
        $response->assertSee('Branche 1');
        $response->assertSee('Établissements de Crédit');
        $response->assertSee('Branche 2');
        $response->assertSee('Compagnies d’Assurance', false);
        $response->assertSee('Branche 3');
        $response->assertSee('Intermédiaires de Marché', false);
        $response->assertSee('COBAC');
        $response->assertSee('CIMA');
        $response->assertSee('COSUMAF');
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

    public function test_agrement_dossier_can_be_tracked_without_exposing_contact_data(): void
    {
        AgrementDossier::create([
            'reference' => 'AGR-20260822-ABC123', 'raison_sociale' => 'Acteur Test',
            'type_agrement' => 'Établissement de crédit', 'nom_contact' => 'Jean Test',
            'email' => 'secret@test.ga', 'telephone' => '+24100000000', 'statut' => 'instruction',
        ]);

        $this->post('/suivi-agrement/recherche', ['reference' => 'agr-20260822-abc123'])
            ->assertOk()->assertSee('En cours d’instruction')->assertDontSee('secret@test.ga');
    }

    public function test_chatbot_returns_contextual_guidance(): void
    {
        $this->postJson('/assistant/message', ['message' => 'Comment déposer une réclamation ?'])
            ->assertOk()
            ->assertJsonPath('action.label', 'Déposer une saisine')
            ->assertJsonStructure(['answer', 'action' => ['label', 'url']]);
    }

    public function test_chatbot_validates_empty_messages(): void
    {
        $this->postJson('/assistant/message', ['message' => ''])->assertUnprocessable();
    }

    public function test_contact_form_validation_fails_on_missing_fields(): void
    {
        $response = $this->post('/contact', []);
        $response->assertSessionHasErrors(['nom', 'email', 'objet', 'message']);
    }

    public function test_mediation_saisine_stores_request(): void
    {
        \Illuminate\Support\Facades\Mail::fake();

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
        $response->assertSessionHas('dossier_reference');
        $this->assertDatabaseHas(MediationRequest::class, ['email' => 'marie@test.ga']);

        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\MediationConfirmationMail::class, function ($mail) {
            return $mail->hasTo('marie@test.ga') && str_starts_with($mail->saisine->reference, 'MF-');
        });
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

    public function test_mediation_suivi_can_track_dossier_by_confidential_reference(): void
    {
        $dossier = MediationRequest::create([
            'reference' => 'MF-2026-TEST99',
            'prenom' => 'Alain',
            'nom' => 'Mba',
            'email' => 'alain@test.ga',
            'etablissement' => 'BGFI Bank Gabon',
            'nature_litige' => 'Frais bancaires et agios contestés',
            'description' => 'Contestation de frais prélevés à tort.',
            'statut' => 'recevable',
            'observation_mediateur' => 'Le dossier a été transmis à la banque pour contradictoire.',
        ]);

        // Recherche par URL query string
        $this->get('/mediation-financiere/suivi?reference=MF-2026-TEST99')
            ->assertOk()
            ->assertSee('MF-2026-TEST99')
            ->assertSee('Dossier déclaré recevable')
            ->assertSee('BGFI Bank Gabon')
            ->assertSee('Le dossier a été transmis à la banque pour contradictoire.');

        // Recherche par formulaire POST
        $this->post('/mediation-financiere/suivi', ['reference' => 'MF-2026-TEST99'])
            ->assertOk()
            ->assertSee('MF-2026-TEST99')
            ->assertSee('Dossier déclaré recevable');

        // Référence introuvable
        $this->post('/mediation-financiere/suivi', ['reference' => 'MF-INEXISTANT'])
            ->assertOk()
            ->assertSee('Aucun dossier trouvé');
    }
}
