<x-action-section>
    <x-slot name="title">
        {{ __('Delete Fight') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently delete this fight.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Once a fight is deleted, all of its resources and data will be permanently deleted. Before deleting this fight, please download any data or information regarding this fight that you wish to retain.') }}
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="$toggle('confirmingTeamDeletion')" wire:loading.attr="disabled">
                {{ __('Delete Fight') }}
            </x-danger-button>
        </div>

        <!-- Delete Fight Confirmation Modal -->
        <x-confirmation-modal wire:model.live="confirmingTeamDeletion">
            <x-slot name="title">
                {{ __('Delete Fight') }}
            </x-slot>

            @if(Auth::user()->allTeams()->count() > 1)
            <x-slot name="content">
                {{ __('Are you sure you want to delete this fight? Once a fight is deleted, all of its resources and data will be permanently deleted.') }}
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingTeamDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteTeam" wire:loading.attr="disabled">
                    {{ __('Delete Fight') }}
                </x-danger-button>
            </x-slot>            
            @else
            <x-slot name="content">
                {{ __('You must leave at least one fight.') }}
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingTeamDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>
            </x-slot>
            @endif



        </x-confirmation-modal>
    </x-slot>
</x-action-section>
