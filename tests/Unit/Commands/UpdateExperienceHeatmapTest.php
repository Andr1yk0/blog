<?php

use App\Enums\ConfigKeyEnum;
use App\Enums\ConfigTypeEnum;
use App\Models\Config;

uses(\Tests\RefreshDatabaseCustom::class);

test('generates heatmap', function () {
    $storage = \Storage::fake();
    $config = new Config();
    $config->key = ConfigKeyEnum::EXPERIENCE_HEATMAP;
    $config->type = ConfigTypeEnum::ARRAY->value;
    $config->value = [0 => 'b'];
    $config->save();
    $storage->put(config('heatmap.filename'), \File::get(base_path('tests/fixtures/experience_heatmap.csv')));

    $this->artisan('app:update-experience-heatmap')->assertSuccessful();

    $config = Config::where('key', ConfigKeyEnum::EXPERIENCE_HEATMAP)->first();
    expect($config->value[0]['title'])->toEqual('PHP');
    expect($config->value[0]['months'])->toEqual(14);
    expect($config->value[0]['duration'])->toEqual('1 year 2 months');
    expect($config->value)->toHaveCount(34);
});