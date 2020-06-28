<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;

use Tests\TestCase;
use FewFar\LaravelFrontend\TemplateProvider;

class TemplateProviderTest extends TestCase
{
    public function test_When_RetrievingTemplatesPaths_Then_StorageFacadeShouldBeUsed()
    {
        File::makeDirectory(resource_path('views/templates'), 0755, $recursive = true, $force = true);
        File::cleanDirectory(resource_path('views/templates'));
        File::put(resource_path('views/templates/test.blade.php'), '');

        $this->assertEquals([ 'templates/test' ], app(TemplateProvider::class)->allTemplatesPaths()->toArray());
    }
}
