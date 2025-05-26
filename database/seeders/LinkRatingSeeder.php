<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\Rating;
use App\Models\Evidence;
use App\Models\User;
use Illuminate\Database\Seeder;

class LinkRatingSeeder extends Seeder
{
    public function run()
    {
        // Create test users
        $users = User::factory()->count(5)->create();

        // Create test links
        $links = Link::factory()->count(20)->create();

        // Create ratings for each link
        $links->each(function ($link) use ($users) {
            $users->random(rand(3, 5))->each(function ($user) use ($link) {
                $rating = Rating::create([
                    'link_id' => $link->id,
                    'user_id' => $user->id,
                    'score' => round(rand(-10, 10) / 10, 1) // Random score between -1 and 1 in 0.1 steps
                ]);

                // Add evidence for some ratings
                if (rand(0, 1)) {
                    Evidence::create([
                        'rating_id' => $rating->id,
                        'user_id' => $user->id,
                        'comment' => 'This is a test comment for the rating.'
                    ]);
                }
            });
        });
    }
}
