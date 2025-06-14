<?php

use App\Console\Commands\UpdateExperienceHeatmap;
use App\Enums\ConfigKeyEnum;
use App\Enums\ConfigTypeEnum;
use App\Models\Config;

uses(\Tests\RefreshDatabaseCustom::class);

test('about page without heat map', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});

test('about page with heat map', function () {
    $fakeStorage = \Storage::fake();
    $fakeStorage->put(config('heatmap.filename'), file_get_contents(base_path('tests/fixtures/experience_heatmap.csv')));
    Config::factory()->create(['key' => ConfigKeyEnum::EXPERIENCE_HEATMAP, 'type' => ConfigTypeEnum::ARRAY]);
    $command = new UpdateExperienceHeatmap();
    $command->handle();

    $response = $this->get('/');
    $response->assertStatus(200);
    $response->assertSee('Experience heatmap');
});