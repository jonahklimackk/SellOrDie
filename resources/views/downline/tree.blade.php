<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Your Referral Genealogy
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 overflow-x-auto">
        @if(empty($downlineTree))
            <p class="text-gray-400">You have no referrals yet.</p>
        @else
            <ul class="flex justify-center space-x-12">
                @foreach($downlineTree as $node)
                    <x-downline-node :node="$node" />
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
