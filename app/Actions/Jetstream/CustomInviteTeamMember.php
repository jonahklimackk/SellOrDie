<?php

namespace App\Actions\Jetstream;

use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Contracts\InvitesTeamMembers;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\Team;

class CustomInviteTeamMember implements InvitesTeamMembers
{
    public function invite($user, Team $team, string $email, string $role = null)
    {

        dd('hi');

        // 1️⃣ Block if there’s already any pending invitation
        if ($team->teamInvitations()->exists()) {
            throw ValidationException::withMessages([
                'email' => ['You already have one pending invitation. Please wait until it’s accepted or revoked before sending another.'],
            ]);
        }

        // 2️⃣ (Optional) Prevent duplicate invites to the same email
        if ($team->teamInvitations()->where('email', $email)->exists()) {
            throw ValidationException::withMessages([
                'email' => ['That person has already been invited to this team.'],
            ]);
        }

        // 3️⃣ Delegate to Jetstream’s built-in logic
        Jetstream::inviteTeamMember($user, $team, $email, $role);
    }
}
