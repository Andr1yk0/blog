<?php

namespace Tests\Feature\Controllers;

use App\Console\Commands\UpdateExperienceHeatmap;
use App\Enums\ConfigKeyEnum;
use App\Enums\ConfigTypeEnum;
use App\Models\Config;
use Tests\RefreshDatabaseCustom;
use Tests\TestCase;

class AboutControllerTest extends TestCase
{
    use RefreshDatabaseCustom;

    public function test_about_page_without_heat_map(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_about_page_with_heat_map(): void
    {
        $fakeStorage = \Storage::fake();
        $fakeStorage->put(config('heatmap.filename'), file_get_contents(base_path('tests/fixtures/experience_heatmap.csv')));
        Config::factory()->create(['key' => ConfigKeyEnum::EXPERIENCE_HEATMAP, 'type' => ConfigTypeEnum::ARRAY]);
        $command = new UpdateExperienceHeatmap();
        $command->handle();

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Experience heatmap');

    }
}
