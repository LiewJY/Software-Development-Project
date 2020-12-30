@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="text-lg bg-gray-800 px-6 py-4 text-white">
        {{ $title }}
    </div>

    <div class="mt-2 px-6 py-4">
        {{ $content }}
    </div>

    <div class="px-6 py-4 bg-gray-100 text-right">
        {{ $footer }}
    </div>
</x-jet-modal>
