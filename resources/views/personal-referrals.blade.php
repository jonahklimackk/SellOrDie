
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Personal Referrals') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white shadow rounded-lg p-6">
            @if($referrals->isEmpty())
                <p class="text-gray-500">You have no personal referrals yet.</p>
            @else
                <ul class="space-y-4">
                    @foreach($referrals as $user)
                        <li class="flex items-center justify-between border-b pb-2">
                            <div>
                                <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $user->email }}</div>
                            </div>
                            <div class="text-sm text-gray-400">
                                Joined {{ $user->created_at->diffForHumans() }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>