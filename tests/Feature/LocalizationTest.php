<?php

namespace Tests\Feature;

use Tests\TestCase;

class LocalizationTest extends TestCase
{
    public function test_french_is_the_default_public_locale(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('<html lang="fr">', false)
            ->assertSee('Accueil');
    }

    public function test_a_visitor_can_switch_to_english_and_keep_the_choice(): void
    {
        $this->from('/')
            ->get(route('locale.switch', 'en'))
            ->assertRedirect('/');

        $this->get('/')
            ->assertOk()
            ->assertSee('<html lang="en">', false)
            ->assertSee('Home')
            ->assertSee('Economic monitor');
    }

    public function test_an_unsupported_locale_is_rejected(): void
    {
        $this->get('/langue/de')->assertNotFound();
    }
}
