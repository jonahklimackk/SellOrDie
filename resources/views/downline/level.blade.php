{{-- resources/views/downline/level.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Downline Level') }} {{ $level }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-sod-panel overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold text-white mb-6">
                    {{ __('Level') }} {{ $level }} {{ __('Referrals') }}
                </h1>

                @if($referrals->isEmpty())
                    <p class="text-gray-300">{{ __('No referrals found at this level.') }}</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($referrals as $ref)
                            @php
                                $gravatarUrl = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($ref->email))) . '?s=64&d=identicon';
                            @endphp
                            <div class="flex items-center bg-sod-panel rounded-2xl shadow-lg p-4">
                                @if($ref->profile_photo_path)
                                    <img
                                        src="{{ asset('storage/' . $ref->profile_photo_path) }}"
                                        alt="{{ $ref->name }}"
                                        class="w-16 h-16 rounded-full object-cover mr-4"
                                    >
                                @else
                                    <img
                                        src="{{ $gravatarUrl }}"
                                        alt="{{ $ref->name }}"
                                        class="w-16 h-16 rounded-full object-cover mr-4"
                                    >
                                @endif
                                <div>
                                    <h3 class="text-lg font-semibold text-white">{{ $ref->name }}</h3>
                                    <p class="text-sm text-gray-300">{{ $ref->email }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="mt-8">
                    <a
                        href="{{ route('downline.index') }}"
                        class="inline-block bg-sod-yellow text-gray-900 font-semibold px-4 py-2 rounded-lg hover:bg-yellow-300"
                    >
                        {{ __('← Back to Overview') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
