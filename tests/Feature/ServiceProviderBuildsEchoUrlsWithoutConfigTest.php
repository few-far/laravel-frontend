<?php

namespace Tests\Feature;

use FewFar\LaravelFrontend\ConfigProvider;
use Tests\TestCase;

class ServiceProviderBuildsEchoUrlsWithoutConfigTest extends TestCase
{
    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app->make(ConfigProvider::class)->set('echo_path', null);
    }

    public function test_FallbackPathIsEchoWhenConfigDoesntContainEchoPath()
    {
        // Given
        $expected = [ 'a' => 10 ];

        // When
        $response = $this->get(route('templates.show', 'echo') . '?' . http_build_query(['json' => $expected ]));

        // Then
        $response->assertJson($expected);
    }
}
