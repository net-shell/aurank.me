<?php

namespace Database\Factories;

use App\Models\Evidence;
use Illuminate\Database\Eloquent\Factories\Factory;

class EvidenceFactory extends Factory
{
    protected $model = Evidence::class;

    public function definition()
    {
        return [
            'rating_id' => \App\Models\Rating::factory(),
            'user_id' => \App\Models\User::factory(),
            'comment' => $this->faker->paragraph(),
        ];
    }
}
