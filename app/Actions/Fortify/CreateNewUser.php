<?php

namespace App\Actions\Fortify;

use Mail;
use Illuminate\Support\Facades\Cookie;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use App\Mail\WelcomeNewUser;
use App\Services\AffiliateService;

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
    logger('CreateNewUser::create started');

    Validator::make($input, [
        'name'     => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:100', 'unique:users'],
        'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => $this->passwordRules(),
        'terms'    => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
    ])->validate();

    logger('CreateNewUser::create validation passed');

    return DB::transaction(function () use ($input) {
        logger('CreateNewUser::transaction started');

        return tap(User::create([
            'name'     => $input['name'],
            'username' => $input['username'],
            'email'    => $input['email'],
            'password' => Hash::make($input['password']),
        ]), function (User $user) {
            logger("CreateNewUser::user created – id={$user->id}");

            // 1) Signup bonus
            $user->credits = config('sellordie.signup_bonus');
            $user->save();
            logger("CreateNewUser::assigned signup bonus of {$user->credits} to user_id={$user->id}");

            // 2) Welcome email
            Mail::to($user->email)->send(new WelcomeNewUser($user));
            logger("CreateNewUser::sent WelcomeNewUser email to {$user->email}");

            // 3) Create personal team
            $this->createTeam($user);
            logger("CreateNewUser::created personal team for user_id={$user->id}");

            // 4) Capture affiliate info from cookies
            $referrerId         = Cookie::get('referrer_id');
            $affiliateCampaign  = Cookie::get('affiliate_campaign');
            logger("CreateNewUser::affiliate cookies – referrer_id={$referrerId}, affiliate_campaign={$affiliateCampaign}");

            if ($referrerId) {
                // Persist on the user model
                $user->referrer_id        = $referrerId;
                $user->affiliate_campaign = $affiliateCampaign;
                $user->save();
                logger("CreateNewUser::persisted affiliate info for user_id={$user->id}");

                // Optionally assign to the binary matrix
                AffiliateService::assignMatrixPosition($user);
                logger("CreateNewUser::assigned matrix position to user_id={$user->id}");
            } else {
                logger("CreateNewUser::no referrer_id cookie present, skipping affiliate persistence");
            }

            // 2) Immediately mark them verified
            $user->markEmailAsVerified();

            // 5) (Optional) trigger email verification
            // $user->sendEmailVerificationNotification();

            logger("CreateNewUser::create completed for user_id={$user->id}");
        });
    });
}

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id'       => $user->id,
            'name'          => explode(' ', $user->name, 2)[0] . "'s Fight",
            'personal_team' => true,
        ]));
    }
}
