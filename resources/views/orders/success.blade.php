<x-app-layout>
    <div class="min-h-screen bg-[#111827] flex items-center justify-center p-6">
        <div class="bg-[#1f1c27] p-8 rounded-2xl shadow-2xl max-w-md text-center">
            <h1 class="font-montserrat text-5xl text-yellow-400 mb-4">Thank You!</h1>
            <p class="text-lg text-gray-300 mb-6">
                You have successfully purchased:
                <span class="text-yellow-300 font-semibold">{{ $product }}</span>
            </p>
            <p class="text-gray-400 mb-8">
                Now it’s time to unleash your ad-weapon in the arena. Create a new fight and start dominating!
            </p>
            <a href="/teams/create"
               class="inline-block bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-3 px-6 rounded-full transition transform hover:scale-105">
                Create New Fight
            </a>
        </div>
    </div>
</x-app-layout>