<x-app-layout>


    <div class="py-10 flex justify-center">
        <div class="w-full max-w-3xl space-y-8">

            {{-- Update Fight Name --}}
              <!-- <div class="bg-gray-800 rounded-2xl shadow-2xl p-6"> -->
                @livewire('teams.update-team-name-form', ['team' => $team])
            <!-- </div> -->

            {{-- Manage Fighters --}}
            <!-- <div class="bg-gray-800 rounded-2xl shadow-2xl p-6"> -->
                 @livewire('teams.team-member-manager', ['team' => $team])
            <!-- </div> -->

            {{-- Delete Fight --}}
            @if (Gate::check('delete', $team) && ! $team->personal_team)
                <!-- <div class="bg-gray-800 rounded-2xl shadow-2xl p-6"> -->
                    @livewire('teams.delete-team-form', ['team' => $team])
                <!-- </div> -->
            @endif

        </div>
    </div>
</x-app-layout>
