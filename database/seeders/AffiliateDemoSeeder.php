<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Referral;
use App\Models\Order;
use App\Models\AffiliateSale;

class AffiliateDemoSeeder extends Seeder
{
    /**
     * Run the affiliate demo seeder.
     */
    public function run()
    {
        // 1) Root user
        $root = User::updateOrCreate(
            ['email' => 'root@example.com'],
            [
                'name'     => 'Root User',
                'username' => 'root',
                'password' => bcrypt('password'),
            ]
        );
        $this->makePersonalTeam($root);

        // 2) Alice referred by Root
        $alice = User::updateOrCreate(
            ['email' => 'alice@example.com'],
            [
                'name'     => 'Alice',
                'username' => 'alice',
                'password' => bcrypt('password'),
            ]
        );
        $this->makePersonalTeam($alice);
        Referral::updateOrCreate(
            ['user_id' => $alice->id],
            ['referrer_id' => $root->id, 'campaign' => null]
        );

        // 3) Bob referred by Alice
        $bob = User::updateOrCreate(
            ['email' => 'bob@example.com'],
            [
                'name'     => 'Bob',
                'username' => 'bob',
                'password' => bcrypt('password'),
            ]
        );
        $this->makePersonalTeam($bob);
        Referral::updateOrCreate(
            ['user_id' => $bob->id],
            ['referrer_id' => $alice->id, 'campaign' => 'spring-promo']
        );

        // 4) Demo orders
        $order1 = Order::updateOrCreate(
            ['stripe_session_id' => Str::uuid()],
            [
                'buyer_id' => $alice->id,
                'product'  => 'Lightweight Monthly',
                'amount'   => 9.97,
            ]
        );
        $order2 = Order::updateOrCreate(
            ['stripe_session_id' => Str::uuid()],
            [
                'buyer_id' => $bob->id,
                'product'  => 'Heavyweight Yearly',
                'amount'   => 197.00,
            ]
        );

        // 5) Affiliate sales
        AffiliateSale::updateOrCreate(
            [
                'referrer_id' => $root->id,
                'buyer_id'    => $alice->id,
                'product'     => 'Lightweight Monthly',
            ],
            [
                'campaign' => null,
                'amount'   => 9.97 * config('affiliate.products.Lightweight Monthly.commission', config('affiliate.first_level_rate')),
            ]
        );
        AffiliateSale::updateOrCreate(
            [
                'referrer_id' => $alice->id,
                'buyer_id'    => $bob->id,
                'product'     => 'Heavyweight Yearly',
            ],
            [
                'campaign' => 'spring-promo',
                'amount'   => 197.00 * config('affiliate.products.Heavyweight Yearly.commission'),
            ]
        );
    }

    /**
     * Create a Jetstream personal team for the given user.
     */
    protected function makePersonalTeam(User $user)
    {
        // Create the team via the ownedTeams relation
        $team = $user->ownedTeams()->create([
            'name'          => "{$user->name}'s Team",
            'personal_team' => true,
        ]);

        // Attach the user to the team
        $user->teams()->attach($team->id, ['role' => 'owner']);

        // Set as current team
        $user->forceFill(['current_team_id' => $team->id])->save();
    }
}
