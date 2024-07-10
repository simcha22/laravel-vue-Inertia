<template>
        <div class="relative">
            <img class="h-auto max-w-full rounded-lg" :src="file.url" alt="">
            <div @click="emit('remove', file.url)" class="absolute top-2 right-2 bg-gray-200 text-black cursor-pointer rounded-full w-8 h-8 flex items-center justify-center">
                <!-- Add your button content here (e.g., an icon) -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
</template>

<script setup>
import {ref} from "vue";

const props = defineProps(['file'])
const emit = defineEmits(['remove'])


</script>
