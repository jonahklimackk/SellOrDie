<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\AffiliateSale;
use App\Services\AffiliateService;
use App\Services\MatrixService;

class MatrixAffiliateSeeder extends Seeder
{
    /**
     * Run the matrix + affiliate seeder.
     */
    public function run()
    {
        // 1) Create a top-level affiliate
        $root = User::factory()->create([
            'name'        => 'Affiliate Root',
            'email'       => 'affiliate@example.com',
            'password'    => Hash::make('password'),
            'referrer_id' => null,
        ]);

        // Create their personal team
        $this->createPersonalTeam($root);

        // 2) Recursively build a 2-wide matrix, 3 levels deep
        $this->createDownline($root, $levels = 3, $childrenPerParent = 2);
    }

    /**
     * @param  \App\Models\User  $user
     */
    protected function createPersonalTeam(User $user)
    {
        // Assumes you’re using Jetstream/Spark’s default Team model
        $team = $user->ownedTeams()->create([
            'name'          => "{$user->name}'s Personal Team",
            'personal_team' => true,
        ]);

        // Set as current team
        $user->forceFill(['current_team_id' => $team->id])->save();
    }

    /**
     * @param  \App\Models\User  $parent
     * @param  int               $levels            How many levels of depth to generate
     * @param  int               $childrenPerParent Number of direct referrals per user
     */
    protected function createDownline(User $parent, int $levels, int $childrenPerParent)
    {
        if ($levels <= 0) {
            return;
        }

        for ($i = 1; $i <= $childrenPerParent; $i++) {
            // a) Create the referred user
            $user = User::factory()->create([
                'name'        => "Level {$levels} – User #{$i}",
                'email'       => "level{$levels}_user{$i}@example.com",
                'password'    => Hash::make('password'),
                'referrer_id' => $parent->id,
            ]);

            // Create their personal team
            $this->createPersonalTeam($user);

            // b) Simulate a purchase so your affiliate logic runs
            $amount = rand(50, 200);
            AffiliateSale::create([
                'referrer_id' => $parent->id,
                'buyer_id'    => $user->id,
                'campaign'    => 'seeder_campaign',
                'product'     => 'test_product',
                'amount'      => $amount,
            ]);
            AffiliateService::handleSale($user, $amount);

            // c) Simulate an ad view to exercise matrix spillover
            $creditsForView = rand(20, 60);
            MatrixService::processAdView($user, $creditsForView);

            // d) Recurse
            $this->createDownline($user, $levels - 1, $childrenPerParent);
        }
    }
}
