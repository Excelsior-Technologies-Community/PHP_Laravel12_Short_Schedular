<?php

namespace Database\Factories;

use App\Models\Log;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogFactory extends Factory
{
    protected $model = Log::class;

    public function definition(): array
    {
        return [
            'message' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['success', 'failed']),
        ];
    }
}