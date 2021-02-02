@props(['id' => null, 'maxWidth' => null])
<style>
    .max-height-custom{
        max-height: 65vh;
    }
</style>
<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="text-lg bg-gray-800 px-6 py-4 text-white">
        {{ $title }}
    </div>

    <div class="mt-2 px-6 py-4 max-height-custom overflow-y-auto">
        {{ $content }}
    </div>

    <div class="px-6 py-4 bg-gray-100 text-right">
        {{ $footer }}
    </div>
</x-jet-modal>
