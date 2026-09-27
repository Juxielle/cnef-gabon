<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GoogleAnalyticsTest extends TestCase
{
    use RefreshDatabase;
    public function test_google_tag_is_not_loaded_without_a_measurement_id(): void
    {
        config(['services.google_analytics.measurement_id' => null]);

        $this->get('/')->assertDontSee('googletagmanager.com/gtag/js', false);
    }

    public function test_google_tag_is_loaded_with_a_valid_measurement_id(): void
    {
        config(['services.google_analytics.measurement_id' => 'G-TEST123456']);

        $this->get('/')
            ->assertOk()
            ->assertSee('googletagmanager.com/gtag/js?id=G-TEST123456', false)
            ->assertSee("gtag('config', \"G-TEST123456\")", false);
    }
}
