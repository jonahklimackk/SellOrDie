<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MatrixPosition;
use App\Services\AffiliateService;
use App\Services\CreditService;

class MatrixTestSeeder extends Seeder
{
    /**
     * Seed users, assign them in a forced-binary matrix, and award test credits.
     */
    public function run()
    {
        $this->command->info('🚀 Starting MatrixTestSeeder');

        // 1) Create (or update) a root user and position
        $root = User::updateOrCreate(
            ['email' => 'root@example.com'],
            [
                'name'     => 'Root User',
                'username' => 'root',
                'password' => bcrypt('password'),
            ]
        );
        MatrixPosition::firstOrCreate(
            ['user_id' => $root->id],
            ['parent_id' => null, 'position_index' => 1, 'depth' => 0]
        );
        $this->command->info("✔ Root user #{$root->id} positioned at root");

        // 2) Create additional test users and assign matrix positions
        $testUsers = [];
        for ($i = 1; $i <= 10; $i++) {
            $user = User::updateOrCreate(
                ['email' => "test{$i}@example.com"],
                [
                    'name'     => "Test User {$i}",
                    'username' => "testuser{$i}",
                    'password' => bcrypt('password'),
                ]
            );
            $testUsers[] = $user;
            AffiliateService::assignMatrixPosition($user);
            $pos = MatrixPosition::where('user_id', $user->id)->first();
            $this->command->info("• Positioned Test User #{$user->id} under parent #{$pos->parent_id}, slot {$pos->position_index}");
        }

        // 3) Simulate actions and award credits for the first few users
        foreach (array_slice($testUsers, 0, 3) as $user) {
            CreditService::awardBaseAndMatrix($user->id, 'ad_view', "Seeded ad view for user #{$user->id}");
            $this->command->info("• Awarded ad_view credits for User #{$user->id}");
            CreditService::awardBaseAndMatrix($user->id, 'vote', "Seeded vote for user #{$user->id}");
            $this->command->info("• Awarded vote credits for User #{$user->id}");
        }

        $this->command->info('✅ MatrixTestSeeder complete');
    }
}
