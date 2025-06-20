<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamInvitation;
use Illuminate\Auth\Events\Verified;

class TeamInvitationController extends Controller
{
    /**
     * Accept the given team invitation.
     *
     * Signature must match the Jetstream parent.
     */
    public function accept(Request $request, $invitationId)
    {
        $invitation = TeamInvitation::findOrFail($invitationId);
        $user       = $request->user();
        $team       = $invitation->team;

    // 1) Verify invite was sent to this email
        if ($invitation->email !== $user->email) {
            return back()->dangerBanner(__('This invitation was not sent to your email address.'));
        }

    // 2) Prevent owner from joining own team
        if ($team->owner_id === $user->id) {
            return back()->dangerBanner(__('You cannot join your own fight.'));
        }

    // 3) Prevent duplicate membership
        if ($team->users()->where('user_id', $user->id)->exists()) {
            return back()->dangerBanner(__('You’re already part of this fight.'));
        }

    // 4) Attach the user to the team (pivot only)
        $team->users()->attach($user->id, [
            'role'       => $invitation->role,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    // ─── NEW: switch their current_team_id ───────────
        $user->current_team_id = $team->id;
        $user->save();
    // ────────────────────────────────────────────────

    // 5) Delete the invitation
        $invitation->delete();

    // 6) Redirect to /ads as their “home” for the new team
        return redirect('/ads')
        ->banner(__('You are now part of  “:team”\'s fight! – Enter your ad below to start the fight!', [
         'team' => $team->name,
     ]));
    }
}
