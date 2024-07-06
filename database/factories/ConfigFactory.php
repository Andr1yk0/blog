<?php

namespace Database\Factories;

use App\Enums\ConfigKeyEnum;
use App\Enums\ConfigTypeEnum;
use App\Models\Config;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Config>
 */
class ConfigFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => $this->faker->randomElement(ConfigKeyEnum::cases()),
            'value' => '',
            'type' => $this->faker->randomElement(ConfigTypeEnum::cases())
        ];
    }
}
