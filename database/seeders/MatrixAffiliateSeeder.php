<?php

namespace Database\Seeders;

use Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Team;
use App\Models\AffiliateSale;
use App\Services\AffiliateService;
use App\Services\MatrixService;
use App\Models\Credit;
use App\Models\MatrixPosition;
use Illuminate\Auth\Events\Registered;

class MatrixAffiliateSeeder extends Seeder
{
    public function run()
    {
        // —— OPTIONAL: clear old records if you ever want a clean run ——
        // User::truncate();
        // Team::truncate();

        AffiliateSale::truncate();
        Credit::truncate();
        MatrixPosition::truncate();

        // Delete any users whose password is literally "password"
        User::chunk(100, function ($users) {
            foreach ($users as $user) {
                if (Hash::check('password', $user->password)) {
                    $user->delete();
                }
            }
        });        

        // 1) Root affiliate: only create if one doesn't already exist
        $root = User::firstOrCreate(
            ['email' => 'affiliate@example.com'],
            [
                'name'     => 'Affiliate Root',
                'password' => Hash::make('password'),
                'username' => Str::random(12)
                // 'referrer_id' omitted since root has none
            ]
        );

        // mark root as verified
        $root->markEmailAsVerified();
        event(new Registered($root));

        // Give them a personal team and matrix spot if they don't already have one
        $this->createPersonalTeamIfNeeded($root);
        if (! MatrixPosition::where('user_id', $root->id)->exists()) {
            AffiliateService::assignMatrixPosition($root);
        }

        // 2) Build out a 2-wide, 3-level downline
        $this->createDownline($root, $levels = 7, $childrenPerParent = 5);
    }

    protected function createPersonalTeamIfNeeded(User $user): void
    {
        if (! $user->ownedTeams()->where('personal_team', true)->exists()) {
            $team = $user->ownedTeams()->create([
                'name'          => "{$user->name}'s Personal Team",
                'personal_team' => true,
            ]);
            $user->forceFill(['current_team_id' => $team->id])->save();
        }
    }

    protected function createDownline(User $parent, int $levels, int $childrenPerParent): void
    {
        if ($levels <= 0) {
            return;
        }

        for ($i = 1; $i <= $childrenPerParent; $i++) {
            // a) Create a new referred user with a factory (unique email guaranteed)
            $user = User::factory()
                ->state(['referrer_id' => $parent->id])
                ->create();

            // immediately mark them verified
            $user->markEmailAsVerified();
            event(new Registered($user));

            // b) Give them a team + matrix slot
            $this->createPersonalTeamIfNeeded($user);
            AffiliateService::assignMatrixPosition($user);

            // c) Simulate a purchase & credit
            $amount = rand(50, 200);
            AffiliateSale::create([
                'referrer_id' => $parent->id,
                'buyer_id'    => $user->id,
                'campaign'    => 'seeder_campaign',
                'product'     => 'test_product',
                'amount'      => $amount,
            ]);
            AffiliateService::handleSale($user, $amount);

            // d) Simulate an ad view (matrix spillover)
            $credits = rand(20, 60);
            MatrixService::processAdView($user, $credits);

            // e) Recurse
            $this->createDownline($user, $levels - 1, $childrenPerParent);
        }
    }
}
