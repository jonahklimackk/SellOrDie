<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Helpers\AffiliateTracker;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:100', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();


        return DB::transaction(function () use ($input) {

            AffiliateTracker::recordJoin($input['campaign_id'] );


            return tap(User::create([
                'name' => $input['name'],
                 'username' => $input['username'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'sponsor_id' => $input['sponsor_id'],
            ]), function (User $user) {
                $this->createTeam($user);
            });

            $user->credits = config('sellordie.signup_bonus');
            $user->save();
            Mail::to($user)->send(new WelcomeEmail($user));


            $sponsor = User::fetchSponsor($user);
            $sponsor->credits += config('sellordie.referral_bonus');
            $sponsor->save();
            Mail::to($sponsor)->send(new ReferralNotice($user, $sponsor));


            $admin = User::find(config('sellordie.admin_id'));
            Mail::to($admin)->send(new ReferralNotice($user, $sponsor));



        });
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Fight",
            'personal_team' => true,
        ]));
    }
}
