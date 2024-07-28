<template>
    <Modal :show="show" @close="closeModal" side="right">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                 {{exercise.name}}
            </h2>
            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">{{exercise.category.name}}</span>
            <div v-if="exercise.link">
                <iframe class="mx-auto w-full lg:max-w-xl h-64 rounded-lg sm:h-96 shadow-xl" :src="exercise.link" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

            <div class="p-4 md:p-5">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                    Exercise Details
                </h3>
                <p class="mt-2 text-gray-500 dark:text-neutral-400">
                   {{exercise.details}}
                </p>
            </div>

            <div class="p-4 md:p-5">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                    Exercise Highlights
                </h3>
                <p class="mt-2 text-gray-500 dark:text-neutral-400">
                    {{exercise.highlights}}
                </p>
            </div>
            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="closeModal"> Cancel</SecondaryButton>
            </div>
        </div>
    </Modal>
</template>
<script setup>
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps(['show', 'exercise'])
const emit = defineEmits(['close'])

const closeModal = () =>{
    emit('close')
}
</script>
