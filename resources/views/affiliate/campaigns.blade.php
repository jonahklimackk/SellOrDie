{{-- resources/views/affiliate/dashboard.blade.php --}}
<x-app-layout>


    <div class="py-12 bg-[#1f1c27] text-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      {{-- Sub-menu --}}
      <x-affiliate.submenu />   

<div class="bg-gray-900 overflow-hidden shadow-2xl sm:rounded-2xl p-6">
    <h3 class="text-2xl font-bold text-yellow-300 mb-6">Campaign Performance</h3>

    @if($metrics->isEmpty())
    <div class="bg-gray-800 border-l-4 border-yellow-400 p-4 mb-4">
        <p class="text-gray-300">No affiliate activity yet.</p>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-yellow-300 uppercase tracking-wider">
                        Campaign
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-bold text-yellow-300 uppercase tracking-wider">
                        Clicks
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-bold text-yellow-300 uppercase tracking-wider">
                        Joins
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-bold text-yellow-300 uppercase tracking-wider">
                        Sales
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-bold text-yellow-300 uppercase tracking-wider">
                        Revenue
                    </th>
                </tr>
            </thead>
            <tbody class="bg-gray-900 divide-y divide-gray-700">
                @foreach($metrics as $m)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $m->campaign ?? '/' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        {{ $m->clicks }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        {{ $m->joins }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        {{ $m->sales }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        ${{ number_format($m->revenue, 2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

</div>
</div>
</div>
</x-app-layout>
