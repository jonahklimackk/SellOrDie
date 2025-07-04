@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="bg-gray-800 px-6 py-4">
        <div class="bg-gray-800 text-lg font-medium text-gray-100">
            {{ $title }}
        </div>

        <div class="bg-gray-800 mt-4 text-sm text-gray-400">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-gray-800 text-end">
        {{ $footer }}
    </div>
</x-modal>
