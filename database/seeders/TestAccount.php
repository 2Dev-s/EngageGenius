<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Laravel\Jetstream\Contracts\CreatesTeams;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class TestAccount extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@2devs.agency',
            "role" => 'ADMIN',
            "password" => Hash::make("Test2024"), // Test2024
            "email_verified_at" => now(),
        ]);

        $subscription = $user->subscriptions()->create([
            'type' => 'default',
            'paddle_id' => fake()->unique()->numberBetween(1, 1000),
            'status' => 'active',
            'trial_ends_at' => null,
            'paused_at' => null,
            'ends_at' => null,
        ]);

        $subscription->items()->create([
            'product_id' => fake()->unique()->numberBetween(1, 1000),
            'price_id' => "pri_01hmtf6htyck7hk5axt6baa7fg",
            'status' => 'active',
            'quantity' => 1,
        ]);

        $team = $user->teams()->create([
            "user_id" => $user->id,
            "name" => "Test Team",
            "personal_team" => false
        ]);


        $campain = $team->campains()->create([
            "title" => "Test Campain",
            "description" => "This is a test campain",
            "niche"  => "Test Niche",
            "product_description" => "Test Niche",
            "product_features" => "Test Niche",
            "image_data" => "Test Niche",
            "discount" => 100,
            "cta_text" => "Test Niche",
            "redirect_link" => "Test Niche",
            "start_date" => now(),
            "end_date" => now()->addDays(5),
        ]);
        $campain = $team->campains()->create([
            "title" => "Test Campain",
            "description" => "This is a test campain",
            "niche"  => "Test Niche",
            "product_description" => "Test Niche",
            "product_features" => "Test Niche",
            "image_data" => "Test Niche",
            "discount" => 100,
            "cta_text" => "Test Niche",
            "redirect_link" => "Test Niche",
            "start_date" => now(),
            "end_date" => now()->addDays(5),
        ]);
        $campain = $team->campains()->create([
            "title" => "Test Campain",
            "description" => "This is a test campain",
            "niche"  => "Test Niche",
            "product_description" => "Test Niche",
            "product_features" => "Test Niche",
            "image_data" => "Test Niche",
            "discount" => 100,
            "cta_text" => "Test Niche",
            "redirect_link" => "Test Niche",
            "start_date" => now(),
            "end_date" => now()->addDays(5),
        ]);
        $campain = $team->campains()->create([
            "title" => "Test Campain",
            "description" => "This is a test campain",
            "niche"  => "Test Niche",
            "product_description" => "Test Niche",
            "product_features" => "Test Niche",
            "image_data" => "Test Niche",
            "discount" => 100,
            "cta_text" => "Test Niche",
            "redirect_link" => "Test Niche",
            "start_date" => now(),
            "end_date" => now()->addDays(5),
        ]);
        $campain = $team->campains()->create([
            "title" => "Test Campain",
            "description" => "This is a test campain",
            "niche"  => "Test Niche",
            "product_description" => "Test Niche",
            "product_features" => "Test Niche",
            "image_data" => "Test Niche",
            "discount" => 100,
            "cta_text" => "Test Niche",
            "redirect_link" => "Test Niche",
            "start_date" => now()->addDays(5),
            "end_date" => now()->addDays(10),
        ]);
        $campain = $team->campains()->create([
            "title" => "Test Campain",
            "description" => "This is a test campain",
            "niche"  => "Test Niche",
            "product_description" => "Test Niche",
            "product_features" => "Test Niche",
            "image_data" => "Test Niche",
            "discount" => 100,
            "cta_text" => "Test Niche",
            "redirect_link" => "Test Niche",
            "start_date" => now(),
            "end_date" => now()->addDays(5),
        ]);

        Post::factory(50)->create([
            "team_id" => $team->id,
            "campain_id" => $campain->id
        ]);
    }
}
