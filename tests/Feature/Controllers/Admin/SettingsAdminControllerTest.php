<?php

namespace Tests\Feature\Controllers\Admin;

use App\Console\Commands\UpdateExperienceHeatmap;
use App\Services\SitemapService;
use Illuminate\Http\UploadedFile;
use Mockery\MockInterface;
use Tests\AuthUser;
use Tests\RefreshDatabaseCustom;
use Tests\TestCase;

class SettingsAdminControllerTest extends TestCase
{
    use AuthUser, RefreshDatabaseCustom;

    public function test_generate_sitemap(): void
    {
        $sitemapServiceMock = \Mockery::mock(SitemapService::class, function (MockInterface $mock) {
            $mock->shouldReceive('generateSitemap')->once();
        });
        $this->instance(SitemapService::class, $sitemapServiceMock);

        $response = $this->from('/admin/settings')->setUser()->post('/admin/generate-sitemap');

        $response->assertSessionHas('success')
            ->assertRedirect('/admin/settings');
    }

    public function test_update_heatmap()
    {
        $storage = \Storage::fake();

        $commandMock = \Mockery::mock(UpdateExperienceHeatmap::class, function (MockInterface $mock){
            $mock->shouldReceive('handle')->once();
        });

        $this->instance(UpdateExperienceHeatmap::class, $commandMock);

        $response = $this->from('/admin/settings')->setUser()->put('/admin/update-heatmap', [
            'heatmap' => UploadedFile::fake()->create('heatmap.csv')
        ]);

        $response->assertRedirect('admin/settings')
            ->assertSessionHas('success');
        $storage->assertExists(config('heatmap.filename'));


    }
}
