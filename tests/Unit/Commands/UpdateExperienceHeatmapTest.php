<?php

namespace Tests\Unit\Commands;

use App\Enums\ConfigKeyEnum;
use App\Enums\ConfigTypeEnum;
use App\Models\Config;
use Tests\RefreshDatabaseCustom;
use Tests\TestCase;

class UpdateExperienceHeatmapTest extends TestCase
{
    use RefreshDatabaseCustom;

    public function test_generates_heatmap(): void
    {
        $storage = \Storage::fake();
        $config = new Config();
        $config->key = ConfigKeyEnum::EXPERIENCE_HEATMAP;
        $config->type = ConfigTypeEnum::ARRAY->value;
        $config->value = [0 => 'b'];
        $config->save();
        $storage->put(config('heatmap.filename'), \File::get(base_path('tests/Stubs/files/experience_heatmap.csv')));

        $this->artisan('app:update-experience-heatmap')->assertSuccessful();

        $config = Config::where('key', ConfigKeyEnum::EXPERIENCE_HEATMAP)->first();
        $this->assertEquals('PHP', $config->value[0]['title']);
        $this->assertEquals(4, $config->value[0]['months']);
        $this->assertEquals('4 months', $config->value[0]['duration']);
        $this->assertCount(4, $config->value);
    }
}
