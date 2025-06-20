<div class="mt-0 flex justify-center">
  <div class="w-full max-w-3xl space-y-8">

    {{-- Add Fighter --}}
    @if (Gate::check('addTeamMember', $team) && ! (App\Models\Team::find(Auth::user()->currentTeam->id) && App\Models\Membership::where('team_id', Auth::user()->currentTeam->id)->exists()))
      <div class="bg-gray-900 rounded-2xl shadow-2xl p-6">
        <h2 class="text-2xl font-bold text-yellow-300 mb-2">
          {{ __('Add Fighter') }}
        </h2>
        <p class="text-gray-400 mb-6">
          {{ __('Add a new fighter to your fight, so you can prove who sells best.') }}
        </p>
        <form wire:submit.prevent="addTeamMember" class="space-y-4">
          <div class="text-gray-500 text-sm">
            {{ __('Please provide the email address of the person you would like to fight.') }}
          </div>
          <div>
            <label for="email" class="block text-yellow-200 font-medium mb-1">
              {{ __('Email') }}
            </label>
            <input
              id="email"
              type="email"
              wire:model="addTeamMemberForm.email"
              class="w-full bg-gray-800 text-gray-100 rounded-lg border-transparent focus:border-yellow-400 focus:ring focus:ring-yellow-300 focus:ring-opacity-50 p-2"
            />
            <x-input-error for="email" class="text-red-500 text-sm mt-1" />
          </div>
          {{-- Button right-aligned --}}
          <div class="flex justify-end">
            <button
              type="submit"
              class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold px-6 py-2 rounded-lg shadow-md transition"
            >
              {{ __('Add') }}
            </button>
          </div>
        </form>
      </div>
    @endif

    {{-- Pending Fight Invitations --}}
    @if ($team->teamInvitations->isNotEmpty() && Gate::check('addTeamMember', $team))
      <div class="bg-gray-900 rounded-2xl shadow-2xl p-6">
        <h2 class="text-2xl font-bold text-yellow-300 mb-2">
          {{ __('Pending Fight Invitations') }}
        </h2>
        <p class="text-gray-400 mb-6">
          {{ __('These people have been challenged to your fight and have been sent an invitation email. They may join the fight by accepting the email invitation. Whoever comes first.') }}
        </p>
        <div class="space-y-4">
          @foreach ($team->teamInvitations as $invitation)
            <div class="flex items-center justify-between bg-gray-800 p-4 rounded-xl shadow-md">
              <span class="text-gray-200">{{ $invitation->email }}</span>
              @if (Gate::check('removeTeamMember', $team))
                <button
                  wire:click="cancelTeamInvitation({{ $invitation->id }})"
                  class="text-red-500 hover:text-red-400 text-sm"
                >
                  {{ __('Cancel') }}
                </button>
              @endif
            </div>
          @endforeach
        </div>
      </div>
    @endif

    {{-- Opponent --}}
    @if ($team->users->isNotEmpty())
      <div class="bg-gray-900 rounded-2xl shadow-2xl p-6">
        <h2 class="text-2xl font-bold text-yellow-300 mb-2">
          {{ __('Opponent') }}
        </h2>
        <p class="text-gray-400 mb-6">
          {{ __('The opponent for the fight.') }}
        </p>
        <div class="space-y-4">
          @foreach ($team->users->sortBy('name') as $user)
            <div class="flex items-center justify-between bg-gray-800 p-4 rounded-xl shadow-md">
              <div class="flex items-center gap-4">
                <img
                  src="{{ $user->profile_photo_url }}"
                  alt="{{ $user->name }}"
                  class="w-10 h-10 rounded-full shadow-sm"
                />
                <span class="text-yellow-200 font-medium">{{ $user->name }}</span>
              </div>
              <div class="flex items-center gap-4">
                @if (Laravel\Jetstream\Jetstream::hasRoles())
                  <span class="text-yellow-300 text-sm uppercase font-semibold">
                    {{ Laravel\Jetstream\Jetstream::findRole($user->membership->role)->name }}
                  </span>
                @endif
                @if ($this->user->id === $user->id)
                  <button
                    wire:click="$toggle('confirmingLeavingTeam')"
                    class="text-red-500 hover:text-red-400 text-sm"
                  >
                    {{ __('Leave') }}
                  </button>
                @elseif (Gate::check('removeTeamMember', $team))
                  <button
                    wire:click="confirmTeamMemberRemoval('{{ $user->id }}')"
                    class="text-red-500 hover:text-red-400 text-sm"
                  >
                    {{ __('Remove') }}
                  </button>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endif

    {{-- Modals --}}
    <x-dialog-modal wire:model.live="currentlyManagingRole">
      <x-slot name="title">
        <h3 class="text-xl font-bold text-yellow-300">{{ __('Manage Role') }}</h3>
      </x-slot>
      <x-slot name="content">
        <div class="bg-gray-800 rounded-xl shadow-md divide-y divide-gray-700">
          @foreach ($this->roles as $role)
            <button
              wire:click="$set('currentRole','{{ $role->key }}')"
              class="w-full text-left px-4 py-3 {{ $currentRole !== $role->key ? 'opacity-60' : '' }} focus:outline-none"
            >
              <div class="flex items-center justify-between">
                <span class="text-gray-200 {{ $currentRole == $role->key ? 'font-semibold' : '' }}">
                  {{ $role->name }}
                </span>
                @if ($currentRole == $role->key)
                  <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                  </svg>
                @endif
              </div>
              <p class="mt-1 text-xs text-gray-400">{{ $role->description }}</p>
            </button>
          @endforeach
        </div>
      </x-slot>
      <x-slot name="footer">
        <x-secondary-button wire:click="stopManagingRole" class="bg-gray-800 text-yellow-200 hover:bg-gray-700">
          {{ __('Cancel') }}
        </x-secondary-button>
        <x-button wire:click="updateRole" class="bg-yellow-500 hover:bg-yellow-600 ml-3">
          {{ __('Save') }}
        </x-button>
      </x-slot>
    </x-dialog-modal>

    <x-confirmation-modal wire:model.live="confirmingLeavingTeam">
      <x-slot name="title">
        <h3 class="text-xl font-bold text-yellow-300">{{ __('Leave Fight') }}</h3>
      </x-slot>
      <x-slot name="content">
        <p class="text-gray-200">{{ __('Are you sure you would like to leave this fight?') }}</p>
      </x-slot>
      <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('confirmingLeavingTeam')" class="bg-gray-800 text-yellow-200 hover:bg-gray-700">
          {{ __('Cancel') }}
        </x-secondary-button>
        <x-danger-button wire:click="leaveTeam" class="bg-red-600 hover:bg-red-500 ml-3">
          {{ __('Leave') }}
        </x-danger-button>
      </x-slot>
    </x-confirmation-modal>

    <x-confirmation-modal wire:model.live="confirmingTeamMemberRemoval">
      <x-slot name="title">
        <h3 class="text-xl font-bold text-yellow-300">{{ __('Remove Fighter') }}</h3>
      </x-slot>
      <x-slot name="content">
        <p class="text-gray-200">{{ __('Are you sure you would like to remove this person from the fight?') }}</p>
      </x-slot>
      <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('confirmingTeamMemberRemoval')" class="bg-gray-800 text-yellow-200 hover:bg-gray-700">
          {{ __('Cancel') }}
        </x-secondary-button>
        <x-danger-button wire:click="removeTeamMember" class="bg-red-600 hover:bg-red-500 ml-3">
          {{ __('Remove') }}
        </x-danger-button>
      </x-slot>
    </x-confirmation-modal>

  </div>
</div>
