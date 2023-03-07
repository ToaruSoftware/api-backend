<?php

namespace Database\Factories;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'source' => $this->faker->word(),
            'owner' => rand(1, 2),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_by' => 1
        ];
    }
}
