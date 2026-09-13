<?php

namespace Tests\Feature;

use App\Models\Acteur;
use App\Models\Annonce;
use App\Models\ContactMessage;
use App\Models\MediateurCandidature;
use App\Models\MediationRequest;
use App\Models\SecteurEconomique;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminBackofficeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect(route('admin.login'));
    }

    public function test_login_page_loads(): void
    {
        $this->get('/admin/login')->assertStatus(200);
    }

    public function test_login_fails_with_wrong_credentials(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@cnef.ga',
            'password' => 'wrong-password',
        ]);
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    public function test_login_succeeds_and_reaches_dashboard(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@cnef.ga',
            'password' => 'CnefGabon2025!',
        ]);
        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticated();

        $this->get('/admin')->assertStatus(200)->assertSee('Tableau de bord');
    }

    public function test_logout_works(): void
    {
        $admin = User::first();
        $this->actingAs($admin);
        $response = $this->post('/admin/logout');
        $response->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }

    /** @return array<string,array{0:string}> */
    public static function crudResources(): array
    {
        return [
            'acteurs' => ['acteurs'],
            'annonces' => ['annonces'],
            'textes' => ['textes'],
            'etudes' => ['etudes'],
            'actualites' => ['actualites'],
            'veille-innovations' => ['veille-innovations'],
            'liens' => ['liens'],
            'secteurs' => ['secteurs'],
            'baro-kpis' => ['baro-kpis'],
            'mediation-kpis' => ['mediation-kpis'],
            'mediation-litiges' => ['mediation-litiges'],
            'mediation-saisines' => ['mediation-saisines'],
        ];
    }

    /** @dataProvider crudResources */
    public function test_crud_index_and_create_pages_load(string $resource): void
    {
        $this->actingAs(User::first());

        $this->get("/admin/{$resource}")->assertStatus(200);
        $this->get("/admin/{$resource}/create")->assertStatus(200);
    }

    public function test_acteur_full_crud_lifecycle(): void
    {
        $this->actingAs(User::first());

        $this->post('/admin/acteurs', [
            'nom' => 'Test Acteur',
            'categorie' => 'bancaire',
            'badge' => 'Agrément COBAC',
            'ordre' => 99,
            'description' => 'Description de test.',
            'icone_svg' => '<path d="M3 21h18"/>',
        ])->assertRedirect(route('admin.acteurs.index'));

        $acteur = Acteur::where('nom', 'Test Acteur')->firstOrFail();

        $this->get(route('admin.acteurs.edit', $acteur->id))->assertStatus(200)->assertSee('Test Acteur');

        $this->put(route('admin.acteurs.update', $acteur->id), [
            'nom' => 'Test Acteur Modifié',
            'categorie' => 'paiement',
            'badge' => 'Autorisation CNEF',
            'ordre' => 5,
            'description' => 'Description modifiée.',
            'icone_svg' => '<path d="M3 21h18"/>',
        ])->assertRedirect(route('admin.acteurs.index'));

        $this->assertDatabaseHas(Acteur::class, ['id' => $acteur->id, 'nom' => 'Test Acteur Modifié', 'categorie' => 'paiement']);

        $this->delete(route('admin.acteurs.destroy', $acteur->id))->assertRedirect(route('admin.acteurs.index'));
        $this->assertDatabaseMissing(Acteur::class, ['id' => $acteur->id]);
    }

    public function test_announcement_full_crud_lifecycle(): void
    {
        $this->actingAs(User::first());

        $this->post('/admin/annonces', [
            'titre' => 'Fermeture exceptionnelle',
            'message' => 'Les bureaux seront fermés au public.',
            'niveau' => 'important',
            'starts_at' => now()->subHour()->format('Y-m-d H:i:s'),
            'ends_at' => now()->addDay()->format('Y-m-d H:i:s'),
            'published' => '1',
            'ordre' => 1,
        ])->assertRedirect(route('admin.annonces.index'));

        $annonce = Annonce::where('titre', 'Fermeture exceptionnelle')->firstOrFail();
        $this->get('/')->assertOk()->assertSee('Fermeture exceptionnelle');

        $this->put(route('admin.annonces.update', $annonce), [
            'titre' => 'Réouverture exceptionnelle',
            'message' => 'Les bureaux sont de nouveau ouverts.',
            'niveau' => 'information',
            'starts_at' => now()->subHour()->format('Y-m-d H:i:s'),
            'ends_at' => now()->addDays(2)->format('Y-m-d H:i:s'),
            'published' => '1',
            'ordre' => 2,
        ])->assertRedirect(route('admin.annonces.index'));

        $this->assertDatabaseHas(Annonce::class, [
            'id' => $annonce->id,
            'titre' => 'Réouverture exceptionnelle',
            'published' => true,
        ]);

        $this->delete(route('admin.annonces.destroy', $annonce))
            ->assertRedirect(route('admin.annonces.index'));
        $this->assertDatabaseMissing(Annonce::class, ['id' => $annonce->id]);
    }

    public function test_secteur_economique_structured_fields_roundtrip(): void
    {
        $this->actingAs(User::first());

        $payload = [
            'slug' => 'test-secteur',
            'titre' => 'Secteur de test',
            'sante' => 'bon',
            'ordre' => 9,
            'chart_label_1' => 'Label 1',
            'chart_label_2' => 'Label 2',
            'kpis' => [['l' => 'Indicateur', 'v' => '10%', 'd' => '+1%']],
            'branches' => [['n' => 'Branche A', 'pib' => 20, 'ev' => 3, 'note' => 'Bon']],
            'chart_categories' => ['2023', '2024'],
            'chart_dataset_1' => [1, 2],
            'chart_dataset_2' => [3, 4],
        ];

        $this->post('/admin/secteurs', $payload)->assertRedirect(route('admin.secteurs.index'));

        $secteur = SecteurEconomique::where('slug', 'test-secteur')->firstOrFail();
        $this->assertEquals('Indicateur', $secteur->kpis[0]['l']);
        $this->assertEquals('Branche A', $secteur->branches[0]['n']);
        $this->assertEquals([1, 2], $secteur->chart_dataset_1);

        $this->get(route('admin.secteurs.edit', $secteur->id))->assertStatus(200)->assertSee('Secteur de test');

        $this->delete(route('admin.secteurs.destroy', $secteur->id))->assertRedirect(route('admin.secteurs.index'));
    }

    public function test_structured_fields_are_shown_instead_of_json_textareas(): void
    {
        $this->actingAs(User::first());

        $this->get('/admin/secteurs/create')
            ->assertOk()
            ->assertSee('Ajouter un indicateur')
            ->assertSee('Ajouter une branche')
            ->assertSee('Ajouter une période')
            ->assertDontSee('Indicateurs clés (JSON)');

        $this->get('/admin/veille-innovations/create')
            ->assertOk()
            ->assertSee('Ajouter un tag')
            ->assertDontSee('Tags (JSON)');
    }

    public function test_svg_fields_use_a_visual_picker_and_reject_unsafe_code(): void
    {
        $this->actingAs(User::first());

        $this->get('/admin/acteurs/create')
            ->assertOk()
            ->assertSee('Importer un SVG')
            ->assertSee('Banque')
            ->assertDontSee('balise SVG');

        $this->get('/admin/liens/create')
            ->assertOk()
            ->assertSee('Cameroun')
            ->assertSee('Gabon')
            ->assertDontSee('SVG complet');

        $this->post('/admin/acteurs', [
            'nom' => 'Icône dangereuse',
            'categorie' => 'bancaire',
            'badge' => 'Test',
            'description' => 'Test de validation.',
            'icone_svg' => '<path d="M1 1" onload="alert(1)"/>',
        ])->assertSessionHasErrors('icone_svg');
    }

    public function test_mediation_request_submission_management(): void
    {
        $this->actingAs(User::first());

        $mediation = MediationRequest::create([
            'reference' => 'MED-TEST-0001',
            'prenom' => 'Jean',
            'nom' => 'Test',
            'email' => 'jean@test.ga',
            'etablissement' => 'BGFI Bank Gabon',
            'nature_litige' => 'Contestation de frais ou commission',
            'description' => 'Litige de test.',
            'statut' => 'nouveau',
        ]);

        $this->get('/admin/mediation-requests')->assertStatus(200)->assertSee('MED-TEST-0001');
        $this->get("/admin/mediation-requests/{$mediation->id}")->assertStatus(200)->assertSee('Jean');

        $this->patch("/admin/mediation-requests/{$mediation->id}/status", ['statut' => 'en_cours'])
            ->assertRedirect(route('admin.mediation-requests.show', $mediation->id));

        $this->assertDatabaseHas(MediationRequest::class, ['id' => $mediation->id, 'statut' => 'en_cours']);

        $this->delete("/admin/mediation-requests/{$mediation->id}")->assertRedirect(route('admin.mediation-requests.index'));
        $this->assertDatabaseMissing(MediationRequest::class, ['id' => $mediation->id]);
    }

    public function test_contact_message_boolean_status(): void
    {
        $this->actingAs(User::first());

        $message = ContactMessage::create([
            'nom' => 'Marie Test',
            'email' => 'marie@test.ga',
            'objet' => 'Question réglementaire',
            'message' => 'Message de test.',
        ]);

        $this->get('/admin/messages')->assertStatus(200)->assertSee('Marie Test');

        $this->patch("/admin/messages/{$message->id}/status", ['traite' => '1'])
            ->assertRedirect(route('admin.messages.show', $message->id));

        $this->assertDatabaseHas(ContactMessage::class, ['id' => $message->id, 'traite' => true]);
    }

    public function test_mediateur_candidature_submission_management(): void
    {
        $this->actingAs(User::first());

        $candidature = MediateurCandidature::create([
            'prenom' => 'Paul',
            'nom' => 'Test',
            'email' => 'paul@test.ga',
            'branche' => 'Branche 1',
            'statut' => 'recue',
        ]);

        $this->get('/admin/candidatures')->assertStatus(200)->assertSee('Paul');
        $this->get("/admin/candidatures/{$candidature->id}")->assertStatus(200);

        $this->patch("/admin/candidatures/{$candidature->id}/status", ['statut' => 'en_examen'])
            ->assertRedirect(route('admin.candidatures.show', $candidature->id));

        $this->assertDatabaseHas(MediateurCandidature::class, ['id' => $candidature->id, 'statut' => 'en_examen']);
    }
}
