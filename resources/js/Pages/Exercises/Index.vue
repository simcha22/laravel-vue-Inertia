<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import {ref} from "vue";

import CreateModal from "@/Pages/Exercises/Components/CreateModal.vue";
import ExerciseItem from "@/Pages/Exercises/Components/ExerciseItem.vue";

const props = defineProps(['exercises'])
const showCreateExercise = ref(false)

const closeModal =() =>{
    showCreateExercise.value = false
}
</script>

<template>
    <Head title="Exercises"/>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Exercises</h2>
                <button @click="showCreateExercise = true"
                        class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2">
                    Create new Exercise
                </button>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div class="relative overflow-x-auto">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <ExerciseItem v-for="exercise in exercises" :exercise="exercise"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <CreateModal :show="showCreateExercise" @close="closeModal"/>
    </AuthenticatedLayout>
</template>
