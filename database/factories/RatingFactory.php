<?php

namespace Database\Factories;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    protected $model = Rating::class;

    public function definition()
    {
        return [
            'link_id' => \App\Models\Link::factory(),
            'user_id' => \App\Models\User::factory(),
            'score' => $this->faker->randomFloat(1, -1, 1),
        ];
    }
}
