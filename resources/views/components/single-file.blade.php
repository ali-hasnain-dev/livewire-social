<template x-if="data.images[0].type.startsWith('image')">
    <img :src="data.images[0].url" alt="Single Image" class="w-auto h-auto rounded-md">
</template>
<template x-if="type.startsWith('video')">
    <video :src="data.images[0].url" controls class="w-full rounded-md"></video>
</template>
