@props([
    'image' => null,
    'type' => null,
])

<div x-data="{ image: '{{ $image }}', type: '{{ $type }}' }" x-init="console.log(image, type)">
    <template x-if="type.startsWith('image')">
        <img src="{{ asset($image) }}" alt="Single Image" class="w-auto h-auto rounded-md">
    </template>
    <template x-if="type.startsWith('video')">
        <video src="{{ asset($image) }}" controls class="w-full rounded-md"></video>
    </template>
</div>
