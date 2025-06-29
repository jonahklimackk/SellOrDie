{{-- resources/views/downline/index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Downline') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-sod-panel overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold text-sod-yellow mb-6">{{ __('Downline Overview') }}</h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @for ($lvl = 1; $lvl <= 7; $lvl++)
                        <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center">
                            <h2 class="text-lg font-semibold text-gray-700 mb-2">{{ __('Level') }} {{ $lvl }}</h2>
                            <p class="text-5xl font-bold text-gray-900">
                                {{ $counts->{'level' . $lvl . '_count'} ?? 0 }}
                            </p>
                        </div>
                    @endfor
                </div>

                <div class="mt-8 text-center">
                    @php
                        $total = 0;
                        for ($i = 1; $i <= 7; $i++) {
                            $total += $counts->{'level' . $i . '_count'} ?? 0;
                        }
                    @endphp
                    <span class="text-lg text-gray-300">
                        {{ __('Total in Downline') }}: <span class="font-semibold text-white">{{ $total }}</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
